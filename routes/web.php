<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CkeckAuthAdmin;

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
    redirect('/login');
});

Route::get('/login', 'AdminController@index')->name('login.admin');
/*Route::get('/admin/users','UserController@view');
Route::get('/admin/users/list-users','UserController@listUsers');
Route::post('/admin/users/create-user','UserController@registerUser');
Route::post('/admin/users/update-user/{id}','UserController@editUser');
Route::post('/admin/users/resetPassword', 'UserController@resetPassword');
Route::get('/admin/users/get-data-dni/{dni}', 'UserController@getApiDni');*/
Route::post('/login-verification', 'LoginController@loginAdmin');
Route::get('/create-directory', 'UserController@createDirectory');

Route::group(['prefix' => 'admin', 'middleware' => 'auth_admin', 'as' => 'admin.'], function(){
   
    Route::get('/logout','LoginController@logoutAdmin');
    
    Route::group(['prefix' => 'users'], function(){
        Route::get('/', 'UserController@view');
        Route::get('/list-users', 'UserController@listUsers');
        Route::post('/create-user', 'UserController@registerUser');
        Route::post('/update-user/{id}', 'UserController@editUser');
        Route::post('/resetPassword', 'UserController@resetPassword');
        Route::get('/get-data-dni/{dni}', 'UserController@getApiDni');
    });
    
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
    });
});



