<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.login');
    }

    public function dashboard(){
        return view('admin.dashboard'); 
    }

    public function createUser(Request $request){
        $new = New User();
        $new->nombre = $request->nombre;
        //$new->apellid 
        $new->save();

    }
    public function viewUsers(){
        return view('admin.users');
    }



}
