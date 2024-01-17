<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('session.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:255',
            'password' => 'required|max:255'
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        
        if (Auth::attempt($infologin)){
            if (Auth::user()) {
                return redirect('/dashboar');
            }
        } else {
            return redirect('/login')->withErrors('Username atau password yang anda masukkan salah');
        }
    }
    
    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
