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
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('index');
});

Auth::routes();
Route::prefix('asstprovost')->group(function (){
    Route::get('/logout','Auth\AsstprovostLoginController@asstprovostlogout')->name('asstprovost.logout');
    Route::get('/changepasswordshow', 'AsstprovostController@resetpasswordshow')->name('asstprovost.changepassshow');
    Route::post('/changepassword', 'AsstprovostController@resetpassword')->name('asstprovost.changepass');


    Route::get('/dashboard', 'AsstprovostController@index')->name('asstprovost.dashboard');


    Route::get('/roomreqinsertshow','Requestroomcontroller@showroominsertreq')->name('asstprovost.roomreqinsertshow');
    Route::get('/roomreqinsert','Requestroomcontroller@roominsertreq')->name('asstprovost.roomreqinsert');
    Route::get('/perroomreqinfo/{id}','Requestroomcontroller@perroominsertreq')->name('asstprovost.perroominsertreq');
    Route::get('/roominsertallow/{id}','Requestroomcontroller@roominsertallow')->name('asstprovost.roominsertallow');
    Route::get('/roominsertreject/{id}','Requestroomcontroller@roominsertreject')->name('asstprovost.roominsertreject');
    Route::get('/roominsertallowall','Requestroomcontroller@roominsertallowall')->name('asstprovost.roominsertallowall');
    Route::get('/roominsertrejectall','Requestroomcontroller@roominsertrejectall')->name('asstprovost.roominsertrejectall');



    Route::get('/roomreqdeleteshow','Requestroomcontroller@showroomdeletereq')->name('asstprovost.roomreqdeleteshow');
    Route::get('/roomreqdelete','Requestroomcontroller@roomdeletereq')->name('asstprovost.roomreqdelete');
    Route::get('/perroomdeletereqinfo/{id}','Requestroomcontroller@perroomdeletereq')->name('asstprovost.perroomdeletereq');
    Route::get('/roomdeleteallow/{id}','Requestroomcontroller@roomdeleteallow')->name('asstprovost.roomdeleteallow');
    Route::get('/roomdeletereject/{id}','Requestroomcontroller@roomdeletereject')->name('asstprovost.roomdeletereject');
    Route::get('/roomdeleteallowall','Requestroomcontroller@roomdeleteallowall')->name('asstprovost.roomdeleteallowall');
    Route::get('/roomdeleterejectall','Requestroomcontroller@roomdeleterejectall')->name('asstprovost.roomdeleterejectall');

});
Route::prefix('provost')->group(function (){
    Route::get('/logout','Auth\ProvostLoginController@provostlogout')->name('provost.logout');

    Route::get('/changepasswordshow', 'ProvostController@resetpasswordshow')->name('provost.changepassshow');
    Route::post('/changepassword', 'ProvostController@resetpassword')->name('provost.changepass');

    Route::get('/dashboard', 'ProvostController@index')->name('provost.dashboard');


    Route::get('/studentreqinsertshow','Requestcontroller@showstudentinsertreq')->name('provost.studentreqinsertshow');
    Route::get('/studentreqinsert','Requestcontroller@studentinsertreq')->name('provost.studentreqinsert');
    Route::get('/perstudentreqinfo/{id}','Requestcontroller@perstudentinsertreq')->name('provost.perstudentinsertreq');
    Route::get('/studentinsertallow/{id}','Requestcontroller@studentinsertallow')->name('provost.studentinsertallow');
    Route::get('/studentinsertreject/{id}','Requestcontroller@studentinsertreject')->name('provost.studentinsertreject');
    Route::get('/studentinsertallowall','Requestcontroller@studentinsertallowall')->name('provost.studentinsertallowall');
    Route::get('/studentinsertrejectall','Requestcontroller@studentinsertrejectall')->name('provost.studentinsertrejectall');


    Route::get('/studentreqdeleteshow','Requestcontroller@showstudentdeletereq')->name('provost.studentreqdeleteshow');
    Route::get('/studentreqdelete','Requestcontroller@studentdeletereq')->name('provost.studentreqdelete');
    Route::get('/perstudentdeletereqinfo/{id}','Requestcontroller@perstudentdeletereq')->name('provost.perstudentdeletereq');
    Route::get('/studentdeleteallow/{id}','Requestcontroller@studentdeleteallow')->name('provost.studentdeleteallow');
    Route::get('/studentdeletereject/{id}','Requestcontroller@studentdeletereject')->name('provost.studentdeletereject');
    Route::get('/studentdeleteallowall','Requestcontroller@studentdeleteallowall')->name('provost.studentdeleteallowall');
    Route::get('/studentdeleterejectall','Requestcontroller@studentdeleterejectall')->name('provost.studentdeleterejectall');

});
Route::prefix('home')->group(function (){
    Route::get('/duestatus/{id}','HomeController@showduestatus')->name('student.duestatus');
    Route::get('/changepasswordshow', 'HomeController@resetpasswordshow')->name('student.changepassshow');
    Route::post('/changepassword', 'HomeController@resetpassword')->name('student.changepass');
    Route::get('/logout','Auth\StudentLoginController@studentlogout')->name('student.logout');
    Route::get('/{id}', 'HomeController@index')->name('student.dashboard');
});
Route::prefix('admin')->group(function (){
    Route::get('/logout','Auth\AdminLoginController@adminlogout')->name('admin.logout');


    Route::get('/studentdata','StudentdataController@showstudentIndex')->name('admin.studentdata');
    Route::get('/studentdatashow','StudentdataController@showdata')->name('admin.studentdatashow');
    Route::get('/datatable','StudentdataController@getIndex')->name('admin.datatable');
    Route::get('/tabledata','StudentdataController@anyData')->name('admin.tabledata');
    Route::get('/editstudent/{id}','StudentdataController@edit')->name('admin.editstudent');
    Route::get('/deletestudent/{id}','StudentdataController@destroy')->name('admin.deletestudent');
    Route::post('/updatestudent/{id}','StudentdataController@update')->name('admin.updatestudent');
    Route::get('/perstudentinfo/{id}','StudentdataController@show')->name('admin.perstudent');
    Route::get('/insertstudent','AdminController@showinsertstudent')->name('admin.insertstudent');
    Route::post('/insertstudent','AdminController@insertstudent')->name('admin.insertstudent.submit');
    Route::post('/importstudent','StudentdataController@importstudent')->name('admin.importstudent');
    Route::get('/exportstudent','StudentdataController@exportstudent')->name('admin.exportstudent');
    Route::get('/studentresetpassword/{id}','StudentdataController@resetpassword')->name('admin.sturespassword');





    Route::get('/insertattached','Attachedstudentcontroller@showinsertattached')->name('admin.insertattached');
    Route::post('/insertattached','Attachedstudentcontroller@insertattached')->name('admin.insertattached.submit');
    Route::get('/attacheddata','Attachedstudentcontroller@showattachedIndex')->name('admin.attacheddata');
    Route::get('/attacheddatashow','Attachedstudentcontroller@attachedstudent')->name('admin.attacheddatashow');
    Route::get('/perattachedinfo/{id}','Attachedstudentcontroller@show')->name('admin.perattached');
    Route::get('/editattached/{id}','Attachedstudentcontroller@edit')->name('admin.editattached');
    Route::get('/deleteattached/{id}','Attachedstudentcontroller@destroy')->name('admin.deleteattached');
    Route::post('/updateattached/{id}','Attachedstudentcontroller@update')->name('admin.updateattached');


    Route::get('/messdata/{id}','MessController@showmess')->name('admin.messdata');
    Route::get('/messdatashow/{id}','MessController@showmessdata')->name('admin.messdatashow');
    Route::get('/createmess/{id}','MessController@indexmess')->name('admin.createmess');
    Route::post('/createmess/{id}','MessController@messcreate')->name('admin.createmess.submit');
    Route::get('/termdatashow','MessController@showtermdata')->name('admin.termdatashow');
    Route::get('/permessinfo/{id}','MessController@permess')->name('admin.permess');
    Route::get('/editmess/{id}','MessController@editmess')->name('admin.editmess');
    Route::post('/editmess/{id}','MessController@messupdate')->name('admin.editmess.submit');
    Route::get('/deletemess/{id}','MessController@destroymess')->name('admin.deletemess');

    Route::get('/hallmess','MessController@index')->name('admin.hallmess');



    Route::get('/duemess/{id}','MessController@finepermess')->name('admin.duemess');
    Route::get('/termduecal/{id}','MessController@dueperterm')->name('admin.termduecal');
    Route::get('/termdueshow/{id}','MessController@showdueperterm')->name('admin.termdueshow');
    Route::get('/exporttermdue/{id}','MessController@exporttermdue')->name('admin.exporttermdue');




    Route::get('/openpayment/{id}','MessController@openpayment')->name('admin.openpayment');
    Route::get('/showpaymentdata/{id}','MessController@showpaymentdata')->name('admin.showpayment');
    Route::get('/editpayment/{id}','MessController@editpayment')->name('admin.editpayment');
    Route::post('/editpayment/{id}','MessController@updatepayment')->name('admin.editpayment.submit');
    Route::get('/perpaymentinfo/{id}','MessController@perpayment')->name('admin.perpayment');



    Route::get('/editterm/{id}','MessController@editterm')->name('admin.editterm');
    Route::post('/editterm/{id}','MessController@updateterm')->name('admin.editterm.submit');
    Route::get('/openterm/{id}','MessController@openterm')->name('admin.openterm');
    Route::get('/insertterm','MessController@termindex')->name('admin.insertterm');
    Route::post('/insertterm','MessController@termcreate')->name('admin.insertterm.submit');
    Route::get('/termdata','MessController@showterms')->name('admin.termdata');
    Route::get('/termdatashow','MessController@showtermdata')->name('admin.termdatashow');
    Route::get('/perterminfo/{id}','MessController@perterm')->name('admin.perterm');
    Route::get('/deleteterm/{id}','MessController@destroyterm')->name('admin.deleteterm');


    Route::get('/showinsertroom','Roomcontroller@showinsertroom')->name('admin.showinsertroom');
    Route::post('/insertroom','Roomcontroller@insertroom')->name('admin.insertroom');
    Route::get('/roomdata','Roomcontroller@roomdata')->name('admin.roomdata');
    Route::get('/roomdatashow','Roomcontroller@roomdatashow')->name('admin.roomdatashow');
    Route::get('/perroominfo/{id}','Roomcontroller@perroom')->name('admin.perroominfo');
    Route::get('/showeditroom/{id}','Roomcontroller@showeditroom')->name('admin.showeditroom');
    Route::post('/editroom/{id}','Roomcontroller@editroom')->name('admin.editroom');
    Route::post('/importroom','Roomcontroller@importroom')->name('admin.importroom');
    Route::get('/deleteroom/{id}','Roomcontroller@destroy')->name('admin.deleteroom');
    Route::get('/freeroom','Roomcontroller@freeroom')->name('admin.freeroom');





    Route::get('/insertnoticeshow','Noticecontroller@shownoticeinsert')->name('admin.insertnotice');
    Route::post('/insertnotice','Noticecontroller@insertnotice')->name('admin.insertnotice.submit');
    Route::get('/shownoticedata','Noticecontroller@shownoticedata')->name('admin.shownotice');
    Route::get('/pernoticeinfo/{id}','Noticecontroller@pernotice')->name('admin.pernotice');
    Route::get('/editnoticeshow/{id}','Noticecontroller@editnoticeshow')->name('admin.editnotice');
    Route::post('/editnotice/{id}','Noticecontroller@editnotice')->name('admin.editnotice.submit');
    Route::get('/deletenotice/{id}','Noticecontroller@destroy')->name('admin.deletenotice');


    Route::get('/changepasswordshow', 'AdminController@resetpasswordshow')->name('admin.changepassshow');
    Route::post('/changepassword', 'AdminController@resetpassword')->name('admin.changepass');
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');


});

Route::get('/publicnotice/show','Publicnoticecontroller@publicnotice')->name('publicnotice');
Route::get('/perpublicnotice/{id}','Publicnoticecontroller@perpublicnotice')->name('perpublicnotice');


Route::prefix('all')->group(function () {
    if(Auth::guard('admin')->check()){
        return redirect()->back();
    }
    Route::get('/login', 'Auth\Alllogincontroller@showloginform')->name('all.login');
    Route::post('/login', 'Auth\Alllogincontroller@login')->name('all.login.submit');
    Route::get('/logout', 'Auth\Alllogincontroller@logout')->name('all.logout');
});
