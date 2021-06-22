<?php

namespace App\Http\Controllers;

use App\Http\Traits\SysLog as TraitsSysLog;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    use TraitsSysLog;

    public function view(){
        return view('admin.users');
    }
    public function listUsers(){
        try {
            $data = User::select(
            'id',
            'username',
            'names',
            'lastnamePatern',
            'lastnameMatern',
            'dni',
            'cargo',
            'date_start',
            'state_delete',
            DB::raw('(CASE 
            WHEN users.state_delete = 0 THEN "ACTIVO" 
            WHEN users.state_delete = 1 THEN "INACTIVO"
            END) AS state'),
            'nivel',)->get();
            return response()->json([
                'data' => $data
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function registerUser(Request $request){
       
        try {
            //dd($request);
            $validator = Validator::make($request->all(), [
                'inputName' => 'required|max:255',
                'inputLastNamePatern' => 'required',
                'inputLastNameMatern' => 'required',
                'inputDni' => 'required',
                'inputPassword' => 'required',
                'inputUser' => 'required|max:255',
                //'cargo' => 'required',
                'inputDate' => 'required|date',
                'inputTypeUser' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Ocurrio un error.',
                    'error' => $validator
                ], 400);
            }else{
                
                User::insert([
                    'names' => $request->inputName,
                    'lastNamePatern' => $request->inputLastNamePatern,
                    'lastNameMatern' => $request->inputLastNameMatern,
                    'dni' => $request->inputDni,
                    'password' => bcrypt($request->inputPassword),
                    'nivel' => $request->inputTypeUser,
                    'username' => $request->inputUser,
                    'date_start' => $request->inputDate,
                    'cargo' => 'OTI',
                    'syslog' => $this->syslog_admin(1) 
                    //'syslog' => 'asdasdasd'

                ]);
                
                return response()->json([
                    'message' => 'Usuario Creado Exitosamente'
                ], 200);
            }
            
        } catch(\Exception $e){
            return response()->json([
                'message' => 'Ocurrio un error.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function editUser(Request $request, $id){
        try {
            //dd($request);
            $validator = Validator::make($request->all(), [
                'inputUpdateNames' => 'required',
                'inputUpdateType' => 'required',
                'inputUpdateDni' => 'required',
                'inputUpdateLastnamePatern' => 'required',
                'inputUpdateLastnameMatern' => 'required',
                'inputUpdateDate' => 'required',
                'inputUpdateState' => 'required'
            ]);
            if($validator->fails()){
                return response()->json([
                    'message' => 'Ocurrio un error validator.',
                    'error' => $validator
                ], 400);
            }else{
                $user = User::where('id', $id)->first();
                $user->nivel = $request->inputUpdateType;
                $user->names = $request->inputUpdateNames;
                $user->lastNamePatern = $request->inputUpdateLastnamePatern;
                $user->lastNameMatern = $request->inputUpdateLastnameMatern;
                $user->dni = $request->inputUpdateDni;
                $user->state_delete = $request->inputUpdateState;
                //$user->syslog = $user->syslog . ' | ' . $this->syslog_admin(2);
                $user->save(); 
                return response()->json([
                    'message' => 'Usuario Actualizado Exitosamente'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function resetPassword(Request $request, $id){
        
        try {
            if($request->password == $request->password_confirmation){
                User::where('id', $id)->update([
                    'password' => bcrypt($request->password)
                ]);
                return response()->json([
                    'message' => 'Contraseña modificado exitosamente',
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Ocurrio un error',
                    'error' => 'Las contraseñas no coinciden. Intentelo nuevamente'
                ], 400);
            }
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function username($name, $lastname){
        
        list($pri_nombre, $seg_nombre) = explode(" ", $name);
        list($pri_apellido, $seg_apellido) = explode(" ", $lastname);
        $pri_nombre   = preg_replace('/[ <>\'\"]/', '', $pri_nombre);
        $seg_nombre   = preg_replace('/[ <>\'\"]/', '', $seg_nombre);
        $pri_apellido = preg_replace('/[ <>\'\"]/', '', $pri_apellido);
        $seg_apellido = preg_replace('/[ <>\'\"]/', '', $seg_apellido);

        $largeLastname = strlen($seg_apellido); //largo del nombre
        $username = substr($pri_nombre, 0, 1) . $pri_apellido;
        $data = User::where('username', $username)->first();
        if(!isset($data)){
            return $username;
        }else{
            for($i = 1; $i <= $largeLastname; $i++){
                $username = substr($pri_nombre, 0, 1) . $pri_apellido . substr($seg_apellido, 0, $i);
                $user = User::where('username', $username)->first();
                if(!isset($user)){
                   return $username; 
                }
            }
            $state = FALSE;
            $j = 1;
            while ($state) {
                $username = substr($pri_nombre, 0, 1) . $pri_apellido . substr($seg_apellido, 0, 1) . $j;
                $user = User::where('username', $username)->first();
                if(!isset($user)){
                   return $username; 
                }
                $j++;
            }
        }
    }   
}
