<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', [
    'as' => 'welcome', 'uses' => 'HomeController@welcome'
]);

Route::get('/login', [
    'as' => 'login', 'uses' => 'HomeController@login'
]);

Route::get('index', [
    'as' => 'index', 'uses' => 'HomeController@index'
]);

Route::get('questionnaire/{id}/launch', [
    'as' => 'questionnaire.launch', 'uses' => 'HomeController@launch'
]);

Route::post('question/next', [
    'as' => 'questionnaire.next_question', 'uses' => 'HomeController@next'
]);


Route::get('questionnaire/valider/{id}', 'HomeController@valider');
/*
  |--------------------------------------------------------------------------
  | Authentication Routes
  |--------------------------------------------------------------------------
 */

Route::post('auth/login', 'Auth\AuthController@authenticate');

Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::post('/login', 'HomeController@authenticate');

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
 */

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/', [
        'as' => 'dashboard', 'uses' => 'Admin\AdminController@dashboard'
    ]);

    Route::get('/piequestion', [
        'as' => 'dashboard.piequestion', 'uses' => 'Admin\AdminController@questionByCategoryChart'
    ]);

    Route::get('/piequestionnaire', [
        'as' => 'dashboard.piequestionnaire', 'uses' => 'Admin\AdminController@questionnaireByCategoryChart'
    ]);

    Route::resource('category', 'Admin\CategoryController', ['except' => ['show']]);

    Route::resource('question', 'Admin\QuestionController');
    Route::resource('reponse', 'Admin\ReponseController');
    Route::resource('questionnaire', 'Admin\QuestionnaireController');

    Route::get('questionnaire/listquestion/{id_category}', [
        'as' => 'listquestion', 'uses' => 'Admin\QuestionnaireController@listquestion'
    ]);

    Route::post('question/{id}/test', 'Admin\QuestionController@testQuestion');
});

Route::get('democlass', function(){

});