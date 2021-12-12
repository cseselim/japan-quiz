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
Route::get('lessonList', 'LessonController@show_lesson')->name('lessonlist.list');
Route::get('create', 'LessonController@create')->name('create.lesson');
Route::post('store', 'LessonController@store')->name('store.lesson');
Route::get('lessonEdit/{id?}','LessonController@edit')->name('lesson.edit');
Route::post('lessonUpdate','LessonController@update')->name('lesson.update');
Route::get('lessonDetails/{id?}','LessonController@details')->name('lesson.details');
Route::get('lessonDelete/{id}','LessonController@destroy')->name('lesson.destroy');

Route::get('word', 'WordController@index')->name('word.list');
Route::get('wordView/{id?}', 'WordController@view')->name('word.view');
Route::get('wordCreate', 'WordController@create')->name('create.word');
Route::post('wordStore', 'WordController@store')->name('store.word');
Route::get('wordEdit/{lesson_id}/{id}','WordController@edit')->name('word.edit');
Route::post('wordUpdate','WordController@update')->name('word.update');
Route::get('wordDelete/{id}','WordController@destroy')->name('word.destroy');

Route::get('Question', 'QuestionController@index')->name('question.list');
Route::get('QuestionCreate', 'QuestionController@create')->name('question.create');
Route::post('QuestionStore', 'QuestionController@store')->name('store.question');
Route::get('QuestionEdit/{id?}','QuestionController@edit')->name('Question.edit');
Route::post('QuestionUpdate','QuestionController@update')->name('Question.update');
Route::get('QuestionDelete/{id}','QuestionController@destroy')->name('Question.destroy');
