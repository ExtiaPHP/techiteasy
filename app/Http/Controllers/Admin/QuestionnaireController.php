<?php

namespace App\Http\Controllers\Admin;

use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Questionnaire;
use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionnaireHasQuestion;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page       = 'questionnaire';
        $questionnaires = Questionnaire::paginate(8);
        $questionnaires->setPath('questionnaire');
        
        return view('admin.questionnaire', compact('page', 'questionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page     = 'questionnaire';
        $questionnaire = new Questionnaire;

        $categories = Category::get()->lists('name','id')->toArray();

        return view('admin.questionnaire-create-update', compact('page', 'questionnaire', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $page     = 'questionnaire';
        $questionnaire = questionnaire::findOrFail($id);

        $categories = Category::get()->lists('name','id')->toArray();

        $questions = implode(',',QuestionnaireHasQuestion::where('questionnaire_id', '=', $id)->get()->lists('question_id', 'question_id')->toArray());

        return view('admin.questionnaire-create-update', compact('page', 'questionnaire', 'categories', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $questions = json_decode($request->input('listcheck'), true);
        $champ = trans('content.questionnaire_edit_label_nom');

        $validator = Validator::make([ $champ => $request->input('title'),'q' => $questions],
            [ $champ => 'required', 'q' => 'emptyquestion']);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $page     = 'questionnaire';
        $questionnaire = questionnaire::findOrFail($id);
        $questionnaire->title = $request->input('title');
        
        //we save
        $questionnaire->save();


        QuestionnaireHasQuestion::where('questionnaire_id', '=', $id)->delete();

        $this->saveQuestion($questions, $id);

        return redirect()
                ->route('admin.questionnaire.index')
                ->withSuccess(trans('content.questionnaire_msg_update_successful'));
    }

    protected function saveQuestion($list, $id) {
        foreach($list  as  $val) {
            DB::table('questionnaire_has_question')->insert(
                array('questionnaire_id' => $id, 'question_id' => $val)
            );
        }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->isMethod('post')) {

            $questions = json_decode($request->input('listcheck'), true);

            $champ = trans('content.questionnaire_edit_label_nom');

            $validator = Validator::make([ $champ => $request->input('title'),'q' => $questions],
                [ $champ => 'required', 'q' => 'emptyquestion']);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $idQuestionnaire = DB::table('questionnaire')->insertGetId(
                    ['title' => $request->input('title')]);

            $this->saveQuestion($questions, $idQuestionnaire);

            return redirect(route('admin.questionnaire.index'));
        }
    }

    public function listquestion($id) {
        return response()->json(['response' => Question::select('question.id', 'level.label as level', 'question.label', 'description')
            ->where('category_id', '=', $id)->join('level', 'question.level_id', '=', 'level.id')->get()]);
    }

    public function destroy($id)
    {
        DB::table('questionnaire_has_question')->where('question_id', '=', $id)->delete();
        DB::table('questionnaire')->where('id', '=', $id)->delete();


        return redirect()
            ->route('admin.questionnaire.index')
            ->withSuccess(trans('content.questionnaire_msg_delete_successful'));
    }

}
