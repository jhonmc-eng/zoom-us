<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
    redirect('/login');
});
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/users', [UserController::class, 'view']);
Route::middleware(CkeckAuthAdmin::class)->group(function () {

   

    /*Route::get('/admin/users', [UserController::class, 'view']);
    Route::get('/admin/users/list-users', [UserController::class], 'listUsers');
    Route::post('/admin/users/create-user', [UserController::class], '');
    Route::post('/admin/users/update-user/{id}', [UserController::class], '');
    Route::post('/admin/users/resetPassword/{id}' [UserController::class], '');*/
});

Route::get('/login', [AdminController::class, 'index']);
Route::get('/admin/users', [AdminController::class, 'viewUsers']);

