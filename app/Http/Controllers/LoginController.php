<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\Toaster;

class LoginController extends Controller
{
    public function page(): View
    {   
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Alert::toast('Login successful!', 'success');
            return redirect()->route('dashboard');
        }

        Alert::error('Error', 'Invalid credentials');
        return back();
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::toast('Logout success!', 'success');
        return redirect()->route('home');
    }
}
