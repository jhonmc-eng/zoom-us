<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function loginAdmin(Request $request){
        try {
            //code...
            $request->validate([
                'username' => 'required|max:255',
                'password' => 'required'
            ]);
            
                //$errors = new \stdClass();
                $user = User::where('username', $request->username)->first();
                //dd($request->username, $request->password, $user);
                if(isset($user)) {
                    if (Hash::check($request->password, $user->password)) {
                        session(['admin' => $user]);
                        return redirect('/admin/users');
                    } else {
                        //$errors->password = 'La contraseña es invalida';
                        return response()->json([
                            'message' => 'Ocurrio un error',
                            'error' => 'La contraseña es invalida'
                        ], 500);
                    }
                } else {
                    //$errors->email = 'El email no esta registrado';
                    return response()->json([
                        'message' => 'Ocurrio un error',
                        'error' => 'El email no esta registrado'
                    ], 500);
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
