<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //

    public function __construct()
    {
        
    }
    public function index(){
        return view('admin.login');
    }

    public function dashboard(){
        return view('admin.dashboard'); 
    }

    public function getDataUser(){
        try {
            $data = DB::connection('convoca_local')->table('tbl_users')->get();
            foreach($data as $item){

            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
        
        //dd($data);   
    }


}
