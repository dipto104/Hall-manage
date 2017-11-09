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
    return view('layouts.appall');
});

Auth::routes();


Route::prefix('home')->group(function (){
    Route::get('/login','Auth\StudentLoginController@showloginform')->name('student.login');
    Route::post('/login','Auth\StudentLoginController@login')->name('student.login.submit');
    Route::get('/logout','Auth\StudentLoginController@studentlogout')->name('student.logout');
    Route::get('/', 'HomeController@index')->name('student.dashboard');
});
Route::prefix('admin')->group(function (){
    Route::get('/login','Auth\AdminLoginController@showloginform')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');

    Route::get('/studentdata','StudentdataController@showdata')->name('admin.studentdata');

    Route::get('/editstudent/{id}','StudentdataController@edit')->name('admin.editstudent');

    Route::get('/hallmess','MessController@index')->name('admin.hallmess');

    Route::get('/insertterm','MessController@termindex')->name('admin.insertterm');
    Route::post('/insertterm','MessController@termcreate')->name('admin.insertterm.submit');

    Route::get('/termdata','MessController@showterms')->name('admin.termdata');

    Route::get('/deletestudent/{id}','StudentdataController@destroy')->name('admin.deletestudent');

    Route::post('/updatestudent/{id}','StudentdataController@update')->name('admin.updatestudent');

    Route::get('/perstudentinfo/{id}','StudentdataController@show')->name('admin.perstudent');

    Route::get('/insertstudent','AdminController@showinsertstudent')->name('admin.insertstudent');
    Route::post('/insertstudent','AdminController@insertstudent')->name('admin.insertstudent.submit');

    Route::get('/logout','Auth\AdminLoginController@adminlogout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');


});

