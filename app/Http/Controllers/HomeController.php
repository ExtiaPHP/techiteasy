<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use App\Http\Requests;

use Mail;
use Config;
use Session;
use Response;

use App\Models\Question;
use App\Models\Answer;


class HomeController extends Controller
{
	/*
	 * The main application page 
	 */
    public function welcome()
    {
    	$data = [];
        return view('welcome', $data); // May use compact
    }

    /*
     * Display the login page for the admin backoffice
     */
    public function login()
    {
    	$data = [];
    	return view('login', $data); // May use compact
    }
    public function authenticate(Request $request){
        session(['email' => $request->input("email"), "firstName" => $request->input("firstName"), "lastName" => $request->input("lastName")]);
 
        return redirect()->route('index');
    }
    public function index(){
        $questionnaires = Questionnaire::paginate(5);

        return view('index', compact('page', 'questionnaires')); // May use compact

        //display questionnaires list        
    }
    public function launch($id){
        Session::put('results', []);

        $questions = Question::select('qhc.question_id', 'label as question_label' , 'description as description_label')
            ->join('questionnaire_has_question as qhc', 'qhc.question_id', '=', 'id')
            ->where('qhc.questionnaire_id', $id)
            ->get()->toArray();

        Session::put('questions', $questions);
        Session::put('questions_total', count($questions));

        $question = $this->nextQuestion();

        return view('launch', [
            'question' => $question,
            'answers' => Answer::where('question_id', '=', $question['question_id'])->get()->lists('label', 'id'),
            'questionnaire_id' => $id
            ]
        );
    }

    protected function nextQuestion() {
        $r = Session::get('questions');
        $s = array_shift($r);

        Session::put('questions', $r);

        return $s;
    }

    public function next(Request $request) {
        $this->result($request->all());

        $question = $this->nextQuestion();

        $end = 0;
        if($question == null)
            $end = 1;

        return Response::json([
            'question' => $question,
            'answers' => Answer::where('question_id', '=', $question['question_id'])->get()->lists('label', 'id'),
            'end' => $end,
            'total' => count(session('results')) / session('questions_total') * 100
        ]);

    }

    protected function result($res) {
        if(Session::has('results')) {
            $r = Session::get('results');
        }

        $answers = json_decode($res['answer'], true);

        $r[] = ['id_question' => $res['question'], 'answer' => $answers];

        Session::put('results', $r);
    }

    public function valider($id){
        $results = session('results');

        $total = 0;
        foreach($results as $ans) {
            $answers = Answer::where('question_id', '=', $ans['id_question'])->get()->lists('verify', 'id')->toArray();
            $questionPoint = Question::join('level', 'level.id', '=', 'question.level_id')->select('point')->first()->point;

            foreach($ans['answer'] as $value) {

                if(!isset($answers[$value]) || $answers[$value] == 0) {
                    $questionPoint--;
                }
            }

            if($questionPoint < 0) $questionPoint = 0;

            $total += $questionPoint;
        }


        $subject = trans('content.mail_subject', ['firstname' => session('lastName'), 'lastname' => session('firstName')]);
        $message = trans('content.mail_body', ['point' => $total]);

        Mail::send('emails.mail', ['body' => $message], function ($m) use ($subject) {
            $m->from(Config::get('mail.from'), 'teachiteasy');

            $m->to(session('email'))->subject($subject);
        });

        return redirect()->route('welcome');

    }

}
