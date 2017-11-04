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
    return view('welcomeall');
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
    Route::get('/insertstudent','AdminController@showinsertstudent')->name('admin.insertstudent');
    Route::get('/logout','Auth\AdminLoginController@adminlogout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');


});

