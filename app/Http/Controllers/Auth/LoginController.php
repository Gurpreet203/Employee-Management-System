<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email:rfs,dns',
            'password' => 'required|min:3|max:255'
        ]);

        if (Auth::attempt($attributes))
        {
            if (Auth::user()->status == User::ACTIVE)
            {
                return redirect('/');
            }

            Auth::logout();
            return back()->with('error', 'You are Inactive user');
        }

        return back()->with('error', 'credentials are wrong');
    }

    public function logout()
    {
        Auth::logout();
        
        return to_route('login');
    }
}
