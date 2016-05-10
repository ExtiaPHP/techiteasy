<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Question;
use App\Models\QuestionnaireHasQuestion;

use Response;

class AdminController extends Controller
{
	/*
	 * The main application page 
	 */
    public function dashboard()
    {
    	$data = [
            'page' => "dashboard"
        ];
        return view('admin.dashboard', $data);
    }

    protected function questionByCategoryChart() {

        $r = Question::groupBy('category_id')
            ->join('category', 'category.id', '=', 'category_id')
            ->select('category.name as name', \DB::raw('count(*) as total'))
            ->lists('total', 'name')
            ->all();

        $total = Question::join('category', 'category.id', '=', 'category_id')
            ->count();


        return Response::json(['data' => $r, 'total' => $total]);
    }

    protected function questionnaireByCategoryChart() {
        $r = QuestionnaireHasQuestion::groupBy('category_id')
            ->join('question', 'question.id', '=', 'question_id')
            ->join('category', 'category.id', '=', 'category_id')
            ->select('category.name as name', \DB::raw('count(*) as total'))
            ->lists('total', 'name')
            ->all();


        $total = QuestionnaireHasQuestion::join('question', 'question.id', '=', 'question_id')
            ->join('category', 'category.id', '=', 'category_id')
            ->count();


        return Response::json(['data' => $r, 'total' => $total]);
    }
    
}
