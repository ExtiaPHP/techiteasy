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
use App\Models\Rh;
use App\Models\ResultSurvey;
use App\Models\Result;

use App\Jobs\ChangeLocale;


class HomeController extends Controller
{
	/*
	 * The main application page 
	 */
    public function welcome()
    {

        $rhs = Rh::get()->lists('name', 'id')->toArray();
        $surveys = Questionnaire::get()->lists('title', 'id')->toArray();

        return view('welcome', compact('rhs', 'surveys')); // May use compact
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
        session([
            'email' => $request->input("email"),
            "firstName" => $request->input("firstName"),
            "lastName" => $request->input("lastName"),
            "rh_id" => $request->input("rh"),
            "survey_id" => $request->input("questionnaire"),
        ]);
 
        return redirect()->route('questionnaire.launch', ['id' => $request->input("questionnaire")]);
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

        $ans = Answer::where('question_id', '=', $question['question_id'])->get()->lists('label', 'id');

        return view('launch', [
            'question' => $question,
            'answers' => $ans->isEmpty() ? null : $ans,
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

        $ans = Answer::where('question_id', '=', $question['question_id'])->get()->lists('label', 'id');

        return Response::json([
            'question' => $question,
            'answers' => $ans->isEmpty() ? null : $ans,
            'end' => $end,
            'total' => count(session('results')) / session('questions_total') * 100
        ]);

    }

    protected function result($res) {
        if(Session::has('results')) {
            $r = Session::get('results');
        }

        $answers = json_decode($res['answer'], true);

        $r[] = ['id_question' => $res['question'], 'answer' => $res['answer_empty'] !== 'null' ? $res['answer_empty'] : $answers];

        Session::put('results', $r);
    }

    public function valider($id){
        $results = session('results');
        $res = new ResultSurvey();
        $res->lastname = session('lastName');
        $res->firstname = session('firstName');
        $res->email = session('email');
        $res->questionnaire_id = session('survey_id');
        $res->rh_id = session('rh_id');
        $res->created_at = date('Y-m-d H:i:s');
        $res->save();

        $total = 0;
        $dataTotal = [];

        foreach($results as $ans) {

            $answers = Answer::where('question_id', '=', $ans['id_question'])->get()->lists('verify', 'id')->toArray();
            $questionPoint = Question::join('level', 'level.id', '=', 'question.level_id')->select('point')->first()->point;

            if(is_array($ans['answer'])) {
                foreach ($ans['answer'] as $k => $value) {
                    $data['result_survey_id'] = $res->id;
                    $data['question'] = Question::find($ans['id_question'])->label;
                    $data['answer'] = Answer::find($value)->label;
                    $data['question_id'] = $ans['id_question'];
                    $dataTotal[] = $data;
                    if (!isset($answers[$value]) || $answers[$value] == 0) {
                        $questionPoint--;
                    }
                }
            }else{
                $data['result_survey_id'] = $res->id;
                $data['question'] = Question::find($ans['id_question'])->label;
                $data['answer'] = $ans['answer'];
                $data['question_id'] = $ans['id_question'];
                $dataTotal[] = $data;
                $k=0;
            }

            if($questionPoint < 0) $questionPoint = 0;

            $total += $questionPoint;

        }

        Result::insert($dataTotal);

        $survey = Questionnaire::find(session('survey_id'));

        $subject = trans('content.mail_subject', ['firstname' => session('lastName'), 'lastname' => session('firstName'), 'survey' => $survey->title]);
        $message = trans('content.mail_body');

        Mail::send('emails.mail', ['body' => $message], function ($m) use ($subject) {
            $m->from(Config::get('mail.from'), 'teachiteasy');

            $m->to(session('email'))->subject($subject);
        });

        return redirect()->route('welcome')->withSuccess(trans('content.mail_send'));

    }

    public function language(Request $request)
    {
        $changeLocale = new ChangeLocale($request->input('lang'));
        $this->dispatch($changeLocale);

        return redirect()->back();
    }

}
