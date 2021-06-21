<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function loginAdmin(Request $request){
        try {
            //code...
            $validator = Validator::make($request->all(), [
                'username' => 'required|max:255',
                'password' => 'required'
            ]);
            if($validator->fails()){
                return response()->json([
                    'message' => 'Ocurrio un error',
                    'error' => $validator
                ], 400);
            }else{
                $errors = new \stdClass();
                $user = User::where('username', $request->username)->first();
                if(isset($user)) {
                    if (Hash::check($request->password, $user->password)) {
                        session(['user' => $user]);
                        return response()->json([
                            'message' => 'Logeado exitosamente' 
                        ], 200);
                    } else {
                        $errors->password = 'La contraseña es invalida';
                        return response()->json([
                            'message' => 'Ocurrio un error',
                            'error' => $errors
                        ], 500);
                    }
                } else {
                    $errors->email = 'El email no esta registrado';
                    return response()->json([
                        'message' => 'Ocurrio un error',
                        'error' => $errors
                    ], 500);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrio un error.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function logoutAdmin(Request $request){
        $request->session()->forget('admin');
        $request->session()->flush();
        return redirect('/login');
    }
}
