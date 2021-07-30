<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', 'AdminController@index')->name('login.admin');
/*Route::get('/admin/users','UserController@view');
Route::get('/admin/users/list-users','UserController@listUsers');
Route::post('/admin/users/create-user','UserController@registerUser');
Route::post('/admin/users/update-user/{id}','UserController@editUser');
Route::post('/admin/users/resetPassword', 'UserController@resetPassword');
Route::get('/admin/users/get-data-dni/{dni}', 'UserController@getApiDni');*/
Route::post('/login-verification', 'LoginController@loginAdmin');
Route::post('/login-verification-candidate', 'LoginController@loginCandidate');
Route::get('/register', 'CandidateController@viewRegister');
Route::get('/get-data-dni/{dni}', 'UserController@getApiDni');
Route::post('/validate-register-candidate', 'CandidateController@registerCandidate');

Route::group(['prefix' => 'admin', 'middleware' => 'auth_admin', 'as' => 'admin.'], function(){
    /*LOGUEARSE DEL ADMIN */
    Route::get('/', 'AdminController@dashboard');
    Route::get('/logout','LoginController@logoutAdmin');
    /*MODULO DE USUARIOS*/
    Route::group(['prefix' => 'users', 'middleware' => 'admin'], function(){
        Route::get('/', 'UserController@view');
        Route::get('/list-users', 'UserController@listUsers');
        Route::post('/create-user', 'UserController@registerUser');
        Route::post('/update-user/{id}', 'UserController@editUser');
        Route::post('/resetPassword', 'UserController@resetPassword');
        Route::get('/get-data-dni/{dni}', 'UserController@getApiDni');
    });
    /* MODULO DE CONVOCATORIA*/
    Route::group(['prefix' => 'jobs'], function(){
        Route::get('/', 'ConvocatoriaController@view');
        Route::get('/list-jobs', 'ConvocatoriaController@listJobs');
        Route::post('/register-job', 'ConvocatoriaController@registerJob');
        Route::post('/update-job/{id}', 'ConvocatoriaController@editJob');
        Route::get('/view-job', 'ConvocatoriaController@viewJob');
        Route::get('/view-base', 'ConvocatoriaController@viewBase');
        Route::get('/view-schedule','ConvocatoriaController@viewSchedule');
        Route::get('/view-profile', 'ConvocatoriaController@viewProfile');
        Route::get('/view-result', 'ConvocatoriaController@viewResult');
        Route::post('/upload-result/{id}', 'ConvocatoriaController@uploadDocuments');
        Route::post('/change-document/{id}', 'ConvocatoriaController@changeDocument');
        Route::post('/delete-document/{id}', 'ConvocatoriaController@deleteDocument');
    });
    /*MODULO DE MODALIDADES*/
    Route::group(['prefix' => 'modalitys', 'middleware' => 'admin'], function(){
        Route::get('/', 'ModalitysController@viewModalitys');
        Route::post('/register-modality','ModalitysController@registerModality');
        Route::get('/list-modalitys','ModalitysController@listModalitys');
        Route::post('/update-modality/{id}','ModalitysController@updateModality');
    });
});

Route::group(['prefix' => 'candidate', 'middleware' => 'auth_candidate', 'as' => 'candidate.'], function(){

    Route::get('/logout-candidate','LoginController@logoutCandidate');

    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', 'CandidateController@viewProfile');
        Route::get('/get-province', 'CandidateController@provinces');
        Route::get('/get-district', 'CandidateController@district');
        Route::post('/update-profile', 'CandidateController@updateProfile');
        Route::get('/view-document', 'CandidateController@viewDocument');
    }); 

    Route::group(['prefix' => 'academic'], function(){
        Route::get('/', 'AcademicController@viewAcademic');
        Route::get('/get-data', 'AcademicController@getDataAcademic');
        Route::post('/register-academic', 'AcademicController@registerAcademic');
        Route::get('/view-document', 'AcademicController@viewDocument');
        Route::post('/update-academic', 'AcademicController@updateAcademic');
        Route::post('/delete-academic', 'AcademicController@deleteAcademic');
    });
    //Route::group)

/*
    Route::group(['prefix' => 'academic'], function(){

    });

    Route::group(['prefix' => 'qualification'], function(){

    });*/
});



