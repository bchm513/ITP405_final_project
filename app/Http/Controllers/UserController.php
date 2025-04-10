<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login() {
        if (Auth::user()) {
            return view('profile', [ // always send user information in
                'user' => Auth::user(),
            ])->with('error', "You are signed in!");
        } else { // no one is signed in, sign them up
            return view('login');
        }
    }

    public function loginForm(Request $request) {

        $validated = $request->validate([
            'email' => 'required|string|max:255', 
            'password' => 'required|string|max:255', 
        ]);
        // dd($validated);

        if (Auth::attempt([ // have to make sure that email and password exist and are correct
            'email' => $validated['email'],
            'password' => $validated['password'] 
        ])) { // Login successful
            return view('profile', [ // always send user information in
                'user' => Auth::user(),
            ]);
        } else { // Invalid credentials
            return view('signup')
                ->with('error', "No user found. Please sign up!");
        }

    }

    public function signup() {
        if (Auth::user()) {
            return view('profile', [ // always send user information in
                'user' => Auth::user(),
            ]);
        } else { // no one is signed in, sign them up
            return view('signup')->with('error', "You are not signed in! Please sign up");
        }
    }

    public function signupForm(Request $request) {
        // dd($request);

        $validated = $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|string|max:255', 
            'password' => 'required|string|max:255', 
        ]);
        // dd($validated);

        // if email is already used then we do not make a new user
        $emailCheck = User::where('email', $validated['email'])->first();

        if ($emailCheck) { // if the email does exist, it is already in use and can't be used to sign up
            return redirect()->route('signup')
                    ->with('error', "That profile has already been taken! Please sign in.");
        } else { // if the email does not exist, it can be used to create a new user
            // dd($emailCheck);

            $newUser = User::create([ // create the new user
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']), 
            ]);

            // dd($newUser);

            Auth::login($newUser); // log in the user after they sign up

            return view('profile', [
                'user' => Auth::user(),
            ]);
        }      
    }

    public function profile() {

        // dd(Auth::user());

        if (Auth::user()) { // if there is a user (someone logged in)
            return view('profile', [ // always send user information in
                'user' => Auth::user(),
            ]);
        } else {
            return view('signup')
                ->with('error', "You are not signed in!");
        }
    }

    public function logout() {

        // dd(Auth::user());

        Auth::logout();

        return redirect()->route('login');
    }
}
