<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegisterController extends Controller
{
    public function page(): View
    {
        return view('register');
    }

    function register(Request $request) 
    {
        
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'nullable|numeric|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'phone_number' => $credentials['phone_number'] ?? null,
            'password' => Hash::make($credentials['password']),
            'role_id' => 3, // Default role_id for regular users
        ]);
        
        Auth::login($user);
        Alert::success('Success', 'Registration success!');
        return redirect()->route('dashboard');    
    }
}
