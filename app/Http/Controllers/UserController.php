<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::with('role')->latest()->get()
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
                'first_name' => 'required|min:3|max:255|alpha',
                'last_name' => 'required|min:3|max:255|alpha',
                'email' => 'required|email:rfs,dns',
                ],
            );
        $attributes += [
            'role_id' => Role::EMPLOYEE
        ];

        $user = User::where('email', $attributes['email'])->withTrashed()->first();
        
        if ($user)
        {
            if ($user->deleted_at != null)
            {
                $user->restore();
                $user->update(array_merge($attributes, [
                    'password' => null,
                    'status' => 0,
                    'email_status' => 0
                ]));             
            }
        }
        else
        {
            $user = User::create($attributes);            
        }
        
        Notification::send($user, new UserNotification(Auth::user()));

        if($request['save'] == 'save')
        {
            return to_route('users.edit', $user)
                ->with('success', 'Successfully Created');
        }

        return back()->with('success', 'Successfully Created');
    }

    public function edit(User $user)
    { 
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'first_name'=>'required|min:3|max:255|alpha',
            'last_name' => 'required|min:3|max:255|alpha',
            ]
        );

        $user->update($attributes);

        return to_route('users')->with('success', 'Successfully Updated');        
    }

    public function delete(User $user)
    {
        $user->delete();

        return back()->with('success', 'Successfully deleted');
    }
}
