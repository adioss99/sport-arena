<?php

namespace App\Http\Middleware;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role = null): Response
    {
        $check = Auth::check();
        if (!$check) {
            // User is not authenticated
            Alert::toast('You are not logged in!', 'error'); 
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role->name;
        if ($check && $userRole === $role) {
            return $next($request);
        } 

        if ($role === null) {
            // If no role is specified, allow access to all authenticated users
          return  $next($request);
        }
        
        if ($userRole !== $role) {
            return $this->redirectToDashboard($userRole);
        }

        abort(403);
    }

    private function redirectToDashboard($role)
    {
        switch ($role) {
            case 'superadmin':
                return redirect()->route('super.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'user':
                return redirect()->route('dashboard');
            default:
                return redirect()->route('login');
        }
    }
}
