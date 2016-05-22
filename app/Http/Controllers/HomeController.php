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

use App\Models\Answer;

use App\Jobs\ChangeLocale;


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
        $questionnaires = [];

        return view('index', compact('page', 'questionnaires')); // May use compact

        //display questionnaires list        
    }

    public function language(Request $request)
    {
        $changeLocale = new ChangeLocale($request->input('lang'));
        $this->dispatch($changeLocale);

        return redirect()->back();
    }

}
