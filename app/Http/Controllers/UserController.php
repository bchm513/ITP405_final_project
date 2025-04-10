<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login() {

    }

    public function signup() {
        return view('signup');
    }

    public function signupForm(Request $request) {
        // dd($request);

        $validated = $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|string|max:255', 
            'password' => 'required|string|max:255', 
        ]);

        dd($validated);
    }
}
