<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class SysLogAdmin extends Controller
{
    //
    public function setlog($type){

        /*$type == 1 ? $action = 'Registrado por : ' : $type == 2 ? $action = "Actualizado por : " : $action = "Eliminado por : ";
        $action = '';*/
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
