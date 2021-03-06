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
            'permission_practices',
            'permission_cas',
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
                'inputCharge' => 'required',
                'inputDate' => 'required|date',
                'inputPermission' => 'required',
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
                $user = New User();
                $user->names = $request->inputName;
                $user->lastNamePatern = $request->inputLastNamePatern;
                $user->lastNameMatern = $request->inputLastNameMatern;
                $user->dni = $request->inputDni;
                $user->password = bcrypt($request->inputPassword);
                $user->nivel = $request->inputTypeUser;
                $user->username = $request->inputUser;
                $user->date_start = $request->inputDate;
                if($request->inputPermission == '1'){
                    $user->permission_cas = 1;
                    $user->permission_practices = 0;
                }else if($request->inputPermission == '2'){
                    $user->permission_cas = 0;
                    $user->permission_practices = 1;
                }else if($request->inputPermission == '3'){
                    $user->permission_cas = 1;
                    $user->permission_practices = 1;
                }else{
                    $user->permission_cas = 0;
                    $user->permission_practices = 0;
                }   
                $user->cargo = $request->inputCharge;

                $user->syslog = $this->syslog_admin(1, $request);
                $user->save();
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
                'inputUpdateCharge' => 'required',
                'inputUpdatePermission' => 'required',
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
            if($request->inputUpdatePermission == '1'){
                $user->permission_cas = 1;
                $user->permission_practices = 0;
            }else if($request->inputUpdatePermission == '2'){
                $user->permission_cas = 0;
                $user->permission_practices = 1;
            }else if($request->inputUpdatePermission == '3'){
                $user->permission_cas = 1;
                $user->permission_practices = 1;
            }else{
                $user->permission_cas = 0;
                $user->permission_practices = 0;
            }   
            $user->cargo = $request->inputUpdateCharge;
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
            $user->syslog = $user->syslog . ' | ' . $this->syslog_admin(2, $request);
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
        //dd($data);
        if($data->success){
            //dd($this->deleteAcent($data->data->nombres),$this->deleteAcent($data->data->apellido_paterno),$this->deleteAcent($data->data->apellido_materno), $data);
            $username = $this->username($this->deleteAcent($data->data->nombres),$this->deleteAcent($data->data->apellido_paterno),$this->deleteAcent($data->data->apellido_materno));
            return response()->json([
                'success' => true,
                'username' => $username,
                'data' => $data->data
            ], 200);
            //dd($data);
        }else{  
            return response()->json([
                'success' => false,
                'message' => 'Ocurrio un error',
                'error' => 'El DNI no existe, intente nuevamente'
            ], 400);
        }
        /*return response()->json([
            'data' => $result
        ], 400);*/ 
               
        
    }

    public function deleteAcent($cadena){

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        //$cadena = utf8_encode($cadena);
    
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('??', '??', '??', '??', '??', '??', '??', '??', '??'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );
    
        $cadena = str_replace(
            array('??', '??', '??', '??', '??', '??', '??', '??'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );
    
        $cadena = str_replace(
            array('??', '??', '??', '??', '??', '??', '??', '??'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );
    
        $cadena = str_replace(
            array('??', '??', '??', '??', '??', '??', '??', '??'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );
    
        $cadena = str_replace(
            array('??', '??', '??', '??', '??', '??', '??', '??'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );
    
        $cadena = str_replace(
            array('??', '??', '??', '??'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );
    
        return $cadena;
    }

    public function passwordAdmin(Request $request){
        try {
            $request->validate([
                'inputPasswordUpdatePassword' => 'required'
            ]);

            $password = User::where('id', session('admin')->id)->first();
            $password->password = bcrypt($request->inputPasswordUpdatePassword);
            $password->syslog = $password->syslog . ' | ' . $this->syslog_admin(2, $request);
            $password->save();
            return response()->json([
                'success' => true,
                'message' => 'Password Actualizado Correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}