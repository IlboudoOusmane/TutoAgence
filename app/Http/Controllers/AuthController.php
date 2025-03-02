<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.property.index'));
        }

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('property.show'));
        }

        return back()->withErrors([
            'email' =>  'Identifiant Incorrect',
            'password' =>  'Identifiant Incorrect'
        ])->onlyInput('email', 'password');
    }


    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }


}
