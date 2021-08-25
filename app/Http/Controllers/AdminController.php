<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Job;
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
        try {
            //code...
            $cas = Job::where([['state_delete', 0],['modality_id', '<>', 2]])->count();
            $practices = Job::where([['state_delete', 0],['modality_id', 2]])->count();
            $users = Candidate::where('state_delete', 0)->count();
            return view('admin.dashboard')->with(compact('cas', 'practices', 'users')); 
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
        
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
