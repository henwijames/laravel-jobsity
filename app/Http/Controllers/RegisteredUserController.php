<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        //validation
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', Password::min(6), 'confirmed']
        ]);

        //create user
        $user = User::create($attributes);

        //login user
        Auth::login($user);

        //redirect
        return redirect('/jobs')->with('success', 'Your account has been created and you are now logged in.');
    }
}
