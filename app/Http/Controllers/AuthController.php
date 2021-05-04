<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $this->logout($request);
        $this->validator($request);
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }

    public function validator(Request $request) {
        $validated = Validator::make($request->only('email', 'password'), ['email' => 'required|email', 'password' => 'required']);
        if($validated->failed()) {
            dd('hit');
            return back()->withErrors($validated->errors());
        }
    }
}
