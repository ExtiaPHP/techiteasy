<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Category;
use DB;
    use Validator;

use App\Models\Level;

class QuestionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $page = 'question';
        $questions = DB::table('question')
                ->select('question.id', 'level.label as level', 'question.label', 'description', 'name')
                ->join('category', 'question.category_id', '=', 'category.id')
                ->join('level', 'question.level_id', '=', 'level.id')
                ->get();
        return view('admin.question', compact('page', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $page = 'question';
        $question = new Question;
        
        $cats = DB::table('category')
                ->get();
        $difficulties = Level::get()->lists('label', 'id')->toArray();
        $categories = [];
        foreach ($cats as $cat) {
            $categories[$cat->id] = $cat->name;
        }
        return view('admin.questionAjout', compact('page', 'question', 'categories', 'difficulties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->isMethod('post')) {

            $idQuestion = DB::table('question')->insertGetId(
                    ['level' => $request->input('difficulties'), 'label' => $request->input('question'), 'description' => $request->input('description'), 'category_id' => $request->input('categories')]);
        
            //insert answers
            $valide_1 = (null == $request->input('reponse_valide_1')  ? "0" : "1");
            $valide_2 = (null == $request->input('reponse_valide_2')  ? "0" : "1");
            
             DB::table('answer')->insert(
                    ['label' => $request->input('answer1'), 'verify' => $valide_1, 'question_id'=>$idQuestion]);
             DB::table('answer')->insert(
                    ['label' => $request->input('answer2'), 'verify' => $valide_2, 'question_id'=>$idQuestion]);
             if($request->input('answer3'))
             {
                $valide_3 = is_null($request->input('reponse_valide_3')  ? "0" : "1");
                 DB::table('answer')->insert(
                    ['label' => $request->input('answer3'), 'verify' => $valide_3 , 'question_id'=>$idQuestion]);
             }
             if($request->input('answer4'))
             {
                $valide_4 = is_null($request->input('reponse_valide_4')  ? "0" : "1");
                 DB::table('answer')->insert(
                    ['label' => $request->input('answer4'), 'verify' => $valide_4, 'question_id'=>$idQuestion]);
             }
             if($request->input('answer5'))
             {
                $valide_5 = is_null($request->input('reponse_valide_5')  ? "0" : "1");
                 DB::table('answer')->insert(
                    ['label' => $request->input('answer5'), 'verify' => $valide_5, 'question_id'=>$idQuestion]);
             }
                 
             if($request->input('answer6'))
             {
                 $valide_6 = is_null($request->input('reponse_valide_6')  ? "0" : "1");
                 DB::table('answer')->insert(
                    ['label' => $request->input('answer6'), 'verify' => $valide_6, 'question_id'=>$idQuestion]);
             }

        }
        return redirect(route('admin.question.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
         /*
         $page = 'question';
        die('edit pepa');
        error_log(print_r('coucouEdit', true));
        */

        $page     = 'question';
        $question = question::findOrFail($id);
        //var_dump($question);die();
        $categories = category::findOrFail($question["category_id"]);

        $cats = DB::table('category')
                ->get();
        $categories = [];
        foreach ($cats as $cat) {
            $categories[$cat->id] = $cat->name;
        }


        $reponses = DB::table('answer')->where('question_id', '=',$id)->get();
        $i = 0;

        $aReponses = array_fill(0, 6, null);
        foreach ($reponses as $rep) {
            $aReponses[$i] = $rep;
            $i++;
        }
        /*
        echo "<pre>";
        var_dump($aReponses);
        echo "</pre>";
        die();
        */

        $difficulties = array("1" => "Débutant", "2" => "Intermédiare", "3" => "Difficile");

        return view('admin.questionAjout', compact('page', 'question','categories','difficulties','aReponses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
     
        //$request
        /*
    echo $request->input('reponse_1_id');
        echo "<pre>";
        var_dump( $request->input('reponse_1_id'));
        echo "</pre>";
      die('PEPA IS HERE');
       
       */

        $page     = 'question';
        $question = question::findOrFail($id);
        $question->category_id = $request->input('categories');
        $question->label = $request->input('description');
        $question->description = $request->input('question');
        $question->level_id = $request->input('difficulties');
        
        //we save
        $question->save();

       
        //reinsert all answers
        if($request->input('reponse_1_id')){
            $valide = (null == $request->input('reponse_valide_1')  ? "0" : "1");
            DB::table('answer')
            ->where('id', $request->input('reponse_1_id') )
            ->update(array('label' => $request->input('answer1'), 'verify' => $valide));
        }

        if($request->input('reponse_2_id')){
            $valide = (null == $request->input('reponse_valide_2')  ? "0" : "1");
            DB::table('answer')
            ->where('id', $request->input('reponse_2_id') )
            ->update(array('label' => $request->input('answer2'), 'verify' => $valide));
        }

        if($request->input('reponse_3_id')){
            $valide = (null == $request->input('reponse_valide_3')  ? "0" : "1");
            DB::table('answer')
            ->where('id', $request->input('reponse_3_id') )
            ->update(array('label' => $request->input('answer3'), 'verify' => $valide));
        }
        elseif ($request->input('answer3')) {
            $valide_3 = is_null($request->input('reponse_valide_3')  ? "0" : "1");
            DB::table('answer')->insert(
                    ['label' => $request->input('answer3'), 'verify' => $valide_3 , 'question_id'=>$id]);
        }

        if($request->input('reponse_4_id')){
            $valide = (null == $request->input('reponse_valide_4')  ? "0" : "1");
            DB::table('answer')
            ->where('id', $request->input('reponse_4_id') )
            ->update(array('label' => $request->input('answer4'), 'verify' => $valide));
        }
        elseif ($request->input('answer4')) {
            $valide_4 = is_null($request->input('reponse_valide_4')  ? "0" : "1");
            DB::table('answer')->insert(
                    ['label' => $request->input('answer4'), 'verify' => $valide_4 , 'question_id'=>$id]);
        }

        if($request->input('reponse_5_id')){
            $valide = (null == $request->input('reponse_valide_5')  ? "0" : "1");
            DB::table('answer')
            ->where('id', $request->input('reponse_5_id') )
            ->update(array('label' => $request->input('answer5'), 'verify' => $valide));
        }
        elseif ($request->input('answer5')) {
            $valide_5 = is_null($request->input('reponse_valide_5')  ? "0" : "1");
            DB::table('answer')->insert(
                    ['label' => $request->input('answer5'), 'verify' => $valide_5 , 'question_id'=>$id]);
        }

        if($request->input('reponse_6_id')){
            $valide = (null == $request->input('reponse_valide_6')  ? "0" : "1");
            DB::table('answer')
            ->where('id', $request->input('reponse_6_id') )
            ->update(array('label' => $request->input('answer6'), 'verify' => $valide));
        }
        elseif ($request->input('answer6')) {

            $valide_6 = (null == $request->input('reponse_valide_6')  ? "0" : "1");
          
            DB::table('answer')->insert(
                    ['label' => $request->input('answer6'), 'verify' => $valide_6 , 'question_id'=>$id]);
        }

         return redirect()
                ->route('admin.question.index')
                ->withSuccess(trans('content.question_msg_edit_successful'));

        
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::table('answer')->where('question_id', '=', $id)->delete();
        DB::table('question')->where('id', '=', $id)->delete();
        return redirect(route('admin.question.index'));
    }

    /**
     * Test si la question est utilisée dans un QCM
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function testQuestion(Request $request, $id) {
        if ($request->ajax()) {
            $questionnaire = DB::table('questionnaire_has_question')
                    ->where('question_id', '=', $id)
                    ->get();
            if (empty($questionnaire)) {
                $reponse = array(
                    'success' => true,
                    'data' => true,
                    'msg' => trans('content.question_index_delete_good')
                );
            } else {
                $reponse = array(
                    'success' => true,
                    'data' => false,
                    'msg' => trans('content.question_index_delete_bad')
                );
            }
            return json_encode($reponse);
        }
    }

}
