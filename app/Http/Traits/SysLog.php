<?php

namespace App\Http\Traits;
use Carbon\Carbon;

trait SysLog {
    public function register(){
        
    }
    public function syslog_admin($type) {
        switch($type){
            case 1: 
                $message = 'Registrado por: '. session('admin')->get('username') . 
                            'Ip: '. session('admin')->ip() . 
                            'Fecha: '. Carbon::now()->toDateTimeString();
                break;
            case 2: 
                $message = 'Actualizado por: '. session('admin')->get('username') . 
                            'Ip: '. session('admin')->ip() . 
                            'Fecha: '. Carbon::now()->toDateTimeString();
                break;
            case 3:
                $message = 'Eliminado por: '. session('admin')->get('username') . 
                            'Ip: '. session('admin')->ip() . 
                            'Fecha: '. Carbon::now()->toDateTimeString();
                break;
        }
        return $message;
    }
    
}