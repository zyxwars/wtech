<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// https://github.com/laravel/breeze/blob/2.x/stubs/default/app/Http/Controllers/Auth/RegisteredUserController.php
class RegisterController extends Controller
{
    /**
     * Show the form for registration.
     */
    public function create()
    {
        return view('register');
    }


    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('home');
    }
}
