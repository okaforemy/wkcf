<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' =>'auth'], function () {
	Route::get('/add-quizz',['uses'=>'QuizzController@addQuizz','as'=>'addquizz'])->middleware('admin');
	Route::post('/ad-quizz',['uses'=>'QuizzController@registerQuizz','as'=>'regquizz'])->middleware('admin');
	Route::get('/view-quizz',['uses'=>'QuizzController@viewQuizz','as'=>'viewquizz'])->middleware('admin');
	Route::get('/quizz/basic',['uses'=>'QuizzController@QuizzBasic','as'=>'quizzbasic']);
	Route::get('/quizz/advanced',['uses'=>'QuizzController@QuizzAdvanced','as'=>'quizzadvanced']);
	Route::get('/settings',['uses'=>'QuizzController@getSettings','as'=>'getquizz']);
	Route::get('/ramdom',['uses'=>'QuizzController@Ramdom','as'=>'ramdom']);
	Route::get('/find-quizz',['uses'=>'QuizzController@findQuizz','as'=>'findquizz']);
	Route::post('/answered',['uses'=>'QuizzController@Answered','as'=>'answered']);
	Route::get('/answered-btn',['uses'=>'QuizzController@checkAnsweredbtn','as'=>'answeredbtn']);
	Route::post('/update-quiz',['uses'=>'QuizzController@updateQuizz','as'=>'updatequiz']);
	Route::get('/delete-quiz',['uses'=>'QuizzController@deleteQuizz','as'=>'deletequizz']);
});

