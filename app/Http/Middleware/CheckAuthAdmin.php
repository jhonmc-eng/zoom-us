<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckAuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!$request->session()->exists('admin')) {
            return redirect('/login');
        }
        foreach($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            switch($role){
                case 'cas':
                    if(!session('admin')->permission_cas)
                        return redirect()->back();
                    break;
                case 'practices':
                    if(!session('admin')->permission_practices)
                        return redirect()->back();
                    break;
                case 'admin':
                    if(session('admin')->nivel != "ADMINISTRADOR")
                        return redirect()->back();
                    break;
                case 'user':
                    if(session('admin')->nivel != 'USUARIO')
                        return redirect()->back();
                    break;
                case 'default':
                    if (!session()->exists('admin'))
                        return redirect()->back();
                    break;
            }
        }
        return $next($request);
    }
    
}
