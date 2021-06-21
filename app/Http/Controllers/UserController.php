<?php

namespace App\Http\Controllers;

use App\Http\Traits\SysLog as TraitsSysLog;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    //
    use TraitsSysLog;
    public function view(){
        return view('admin.users');
    }
    public function listUsers(){
        try {
            $data = User::all();
            return response()->json([
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function registerUser(Request $request){
       
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'lastname' => 'required',
                'email' => 'required|email|max:255',
                'dni' => 'required',
                'password' => 'required',
                'cargo' => 'required',
                'nivel' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Ocurrio un error.',
                    'error' => $validator
                ], 400);
            }else{
                User::insert([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'cargo' => $request->cargo,
                    'nivel' => $request->nivel,
                    'username' => $this->username($request->name, $request->lastname),
                    'syslog' => $this->syslog_admin(1) 
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
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'lastname' => 'required',
                'email' => 'required|email|max:255',
                'dni' => 'required',
                'cargo' => 'required',
                'nivel' => 'required'
            ]);
            if($validator->fails()){
                return response()->json([
                    'message' => 'Ocurrio un error.',
                    'error' => $validator
                ], 400);
            }else{
                $user = User::where('id', $id)->first();
                $user->name = $request->name;
                $user->lastname = $request->lastname;
                $user->email = $request->email;
                $user->dni = $request->dni;
                $user->cargo = $request->cargo;
                $user->nivel = $request->nivel;
                $user->state_delete = $request->state_delete;
                $user->syslog = $user->syslog . ' | ' . $this->syslog_admin(2);
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
