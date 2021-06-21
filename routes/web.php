<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::get('/login', [AdminController::class, 'index'])->name('login.admin');
Route::get('/admin/users',[UserController::class, 'view']);
/*Route::group(['prefix' => 'admin', 'middleware' => 'auth_admin', 'as' => 'admin.', 'namespace' => 'admin'], function(){
    
    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [UserController::class, 'view']);
        Route::get('/list-users', [UserController::class], 'listUsers');
        Route::post('/create-user', [UserController::class], 'registerUser');
        Route::post('/update-user/{id}', [UserController::class], 'editUser');
        Route::post('/resetPassword/{id}' [UserController::class], 'resetPassword');
    });
    
});*/



