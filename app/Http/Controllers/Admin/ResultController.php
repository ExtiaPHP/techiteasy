<?php
/**
 * Created by PhpStorm.
 * User: Brice
 * Date: 04/06/2016
 * Time: 20:06
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;

use App\Models\Result;


class ResultController extends Controller
{
    public function index() {
        $page = 'result';
        $results = DB::table('result_survey')
            ->select('result_survey.lastname', 'result_survey.firstname', 'result_survey.email', 'questionnaire.title as questionnaire_title',
                'rh.lastname as rh_lastname', 'rh.firstname as rh_firstname', 'result_survey.id')
            ->join('questionnaire', 'questionnaire.id', '=', 'result_survey.questionnaire_id')
            ->join('rh', 'rh.id', '=', 'result_survey.rh_id')
            ->get();

        return view('admin.result', compact('page', 'results'));
    }

    public function detail($id) {
        $page = 'result';

        $results = Result::where('result_survey_id', '=', $id)->get();

        $re = [];
        $i = 0;
        $maxCpt = 1;
        foreach($results as $res) {
            if(isset($re[$i-1])) {
                if($res->question_id == $re[$i-1]['id']) {
                    $maxCpt++;
                    $re[$i-1]['cpt']++;
                    $re[$i-1]['answer'.($re[$i-1]['cpt'])] = $res->answer;
                }else{
                    $re[$i] = [
                        'question' => $res->question,
                        'answer1' => $res->answer,
                        'id' => $res->question_id,
                        'cpt' => 1,
                    ];
                }
            }else{
                $re[$i] = [
                    'question' => $res->question,
                    'answer1' => $res->answer,
                    'id' => $res->question_id,
                    'cpt' => 1,
                ];
            }




            $i++;
        }

        return view('admin.result-detail', compact('page', 're', 'maxCpt'));
    }
}