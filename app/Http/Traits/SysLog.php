<?php

namespace App\Http\Traits;
use Carbon\Carbon;
use App\Models\User;

trait SysLog {
    public function register(){
        
    }
    public function syslog_admin($type, $request) {
        switch($type){
            case 1: 
                $message = 'Registrado por: '. session('admin')->username . 
                            ' Ip: '. $request->ip() . 
                            ' Fecha: '. Carbon::now()->toDateTimeString();
                break;
            case 2: 
                $message = 'Actualizado por: '. session('admin')->username . 
                            ' Ip: '. $request->ip() . 
                            ' Fecha: '. Carbon::now()->toDateTimeString();
                break;
            case 3:
                $message = 'Eliminado por: '. session('admin')->username . 
                            ' Ip: '. $request->ip()  . 
                            ' Fecha: '. Carbon::now()->toDateTimeString();
                break;
        }
        return $message;
    }
    public function dniUnique($dni){
        try {
            $user = User::where('dni', $dni)->first();
            //return response()->json(['data' => $user]);
            //dd($user);
            if(isset($user)){
                return true;
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }
    
    public function usernameUnique($username){
        try {
            $user = User::where('username', $username)->first();
            //return response()->json(['data' => $user]);
            //return response()->json(['data' => $user]);
            //dd($user);
            if(isset($user)){
                return true;
            }

        } catch (\Exception $e) {
            dd($e);
        }
    }

    
}