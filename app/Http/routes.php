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

/*
  |--------------------------------------------------------------------------
  | Authentication Routes
  |--------------------------------------------------------------------------
 */

Route::post('auth/login', 'Auth\AuthController@authenticate');

Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::post('/login', 'HomeController@authenticate');

Route::get('language','HomeController@language');

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
 */

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {


    Route::get('/', [
        'as' => 'dashboard', 'uses' => 'Admin\QuestionController@index'
    ]);

    Route::resource('category', 'Admin\CategoryController', ['except' => ['show']]);

    Route::resource('question', 'Admin\QuestionController');
    Route::resource('reponse', 'Admin\ReponseController');
    Route::resource('level', 'Admin\LevelController');

    Route::get('questionnaire/listquestion/{id_category}', [
        'as' => 'listquestion', 'uses' => 'Admin\QuestionnaireController@listquestion'
    ]);

    Route::post('question/{id}/test', 'Admin\QuestionController@testQuestion');
    Route::post('level/{id}/test', 'Admin\LevelController@testLevel');
});

Route::get('democlass', function(){

});