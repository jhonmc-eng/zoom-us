<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/prueba', function(Request $request){
    /*try {
        DB::table('pruebita')->insert([
            'text' => base64_encode(
                file_get_contents(
                    Input::file('prueba')->getRealPath()
                )
            )
        ]);
    
        return response()->json([
            'success' => true
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => true,
            'error' => $e->getMessage()
        ]);
    }*/
    
});
