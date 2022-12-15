<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SetPasswordController extends Controller
{
    public function index(User $user)
    {
        return view('users.initialPassword', [
            'user' => $user
        ]);
    }

    public function store(User $user, Request $request)
    {
        $attributes = $request->validate([
            'password' => 'required|min:8',
            'confirm-password' => 'required|min:8|same:password',
            'email' => 'required'
        ]);

        if ($user->password == null)
        {
            $user->update([
                'password' => Hash::make($attributes['password']),
                'status' => 1,
                'email_status' => 1
            ]);
    
            $login = new LoginController;
            $url = $login->login($request);

            return redirect($url->getTargetUrl());
        }

        return back()->with('error', 'You already set the password to change password please contact admin or forget password');
    }
}
