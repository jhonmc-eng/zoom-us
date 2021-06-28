<?php

namespace App\Http\Controllers;

use App\Http\Traits\SysLog as TraitsSysLog;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    //
    use TraitsSysLog;

    public function view(){
        return view('admin.users.users');
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
                if($this->dniUnique($request->inputDni)){
                    return response()->json([
                        'message' => 'Ocurrio un error',
                        'message' => 'El numero de DNI ya cuenta con un usuario'
                    ],500);
                }
                if($this->usernameUnique($request->inputUser)){
                    return response()->json([
                        'message' => 'Ocurrio un error',
                        'message' => 'El nombre de usuario ya existe'
                    ],500);
                }
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
                    'syslog' => $this->syslog_admin(1, $request)
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
            $validator = $request->validate([
                'inputUpdateNames' => 'required|max:255',
                'inputUpdateLastnamePatern' => 'required',
                'inputUpdateLastnameMatern' => 'required',
                'inputUpdateDni' => 'required',
                'inputUpdateType' => 'required',
                'inputUpdateDate' => 'required',
                'inputUpdateState' => 'required',
                'inputUpdateUsername' => 'required|max:255'
            ]);
            if($this->dniUnique($request->inputDni)){
                return response()->json([
                    'message' => 'Ocurrio un error',
                    'message' => 'El numero de DNI ya cuenta con un usuario'
                ],500);
            }
            if($this->usernameUnique($request->inputUser)){
                return response()->json([
                    'message' => 'Ocurrio un error',
                    'message' => 'El nombre de usuario ya existe'
                ],500);
            }
            $user = User::where('id', $id)->first();
            $user->nivel = $request->inputUpdateType;
            $user->dni = $request->inputUpdateDni;
            $user->names = $request->inputUpdateNames;
            $user->lastNamePatern = $request->inputUpdateLastnamePatern;
            $user->lastNameMatern = $request->inputUpdateLastnameMatern;
            $user->state_delete = $request->inputUpdateState;
            $user->date_start = $request->inputUpdateDate;
            $user->syslog = $user->syslog . ' | ' . $this->syslog_admin(2, $request);
            $user->save(); 
            return response()->json([
                'message' => 'Usuario Actualizado Exitosamente'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function resetPassword(Request $request){
        
        try {
            $request->validate([
                'inputUserUpdatePassword' => 'required',
                'inputPasswordUpdatePassword' => 'required'
            ]);
            $user = User::where('username', '=', $request->inputUserUpdatePassword)->first();
            //dd($user, $request);
            $user->password = Hash::make($request->inputPasswordUpdatePassword);
            $user->save();
            return response()->json([
                'message' => 'Contrasena modificado exitosamente',
            ], 200);
            
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function username($nombres, $pri_apellido, $seg_apellido){
        
        $largeLastname = strlen($seg_apellido); //largo del nombre
        $username = substr($nombres, 0, 1) . $pri_apellido;
        $data = User::where('username', $username)->first();
        if(!isset($data)){
            return strtolower($username);
        }else{
            for($i = 1; $i <= $largeLastname; $i++){
                $username = substr($nombres, 0, 1) . $pri_apellido . substr($seg_apellido, 0, $i);
                $user = User::where('username', $username)->first();
                if(!isset($user)){
                   return strtolower($username); 
                }
            }
            $state = FALSE;
            $j = 1;
            while ($state) {
                $username = substr($nombres, 0, 1) . $pri_apellido . substr($seg_apellido, 0, 1) . $j;
                $user = User::where('username', $username)->first();
                if(!isset($user)){
                   return strtolower($username); 
                }
                $j++;
            }
        }
    }  

    public function createDirectory(Request $request){
        /*$path = public_path().'/files/jobs/convocatoria';
        File::makeDirectory($path, $mode = 0777, true, true);*/
        //$data = User::where('username', 'mendoza')->firstOrFail();
        /*if(User::where('username', 'asd')->exists()){
            return response()->json([
                'data' => 'existe'
            ]);
        }else{
            return response()->json([
                'data' => 'no existe'
            ]);
        }*/
        //$data = Crypt::decryptString('eyJpdiI6IkxCYUlBS3AvZDFEZ0g3NXZwS2V3cWc9PSIsInZhbHVlIjoianpUM3lINzZwcnlvaVJWVzh2b3FHR0VWUmhob3EvRWQ2TGNBQ3A5eWxtYz0iLCJtYWMiOiJhNDc1OGI5Njk1OGQ3Y2E5Y2U5N2NkYTFhMGMwNmU5OTU0MzQ4NmE0YWJhN2MyMTQ5ZGVmYTk4ZTU1OTc4NWZmIn0=');
        $data = base64_decode($request->file);
        /*$decodeData = str_replace('/','', $data);
        return response()->json([
            'data' => $data,
            'decpde' => $decodeData
        ]);*/
        return response()->file(public_path().$data);
        
    }
    
    public function getApiDni($dni){
        $ch = curl_init ();
        curl_setopt($ch,CURLOPT_URL,'https://apiperu.dev/api/dni/' . $dni);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); //times out after 10s
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Authorization: Bearer a6cab70bf5d6b9862d70b8f2bfb1a674208573d48f5bebbfcda2c26a61f8c01b',
                        'X-Requested-With: application/json')
                    );
        $result = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($result);
        
        if(isset($data->success)){
            $username = $this->username($data->data->nombres,$data->data->apellido_paterno,$data->data->apellido_materno);
            return response()->json([
                'username' => $username,
                'data' => $data->data
            ], 200);
            //dd($data);
        }else{  
            return response()->json([
                'message' => 'Ocurrio un error',
                'error' => 'El DNI no existe, intente nuevamente'
            ], 400);
        }
        /*return response()->json([
            'data' => $result
        ], 400);*/ 
               
        
    }
}
