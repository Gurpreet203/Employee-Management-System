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

       $user = User::where('email', $attributes['email'])->first();

        if ($user)
        {
            if ($user->status==User::ACTIVE && Auth::attempt($attributes))
            {
                return redirect('/');
            }
            
            return back()->with('success','You are Inactive user Or your email or password is incorrect');
        }

        return back()->with('error','User Not Found please Make A Account First');
    }

    public function logout()
    {
        Auth::logout();
        
        return to_route('login');
    }
}
