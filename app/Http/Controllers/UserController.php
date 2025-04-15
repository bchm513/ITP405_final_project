<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($id) {

        // dd($id);

        $chefInfo = User::with(['recipes'])->find($id);
        // dd($chefInfo);

        return view('chef-details', ['chefInfo' => $chefInfo]);
    }

    public function chefList() {
        
        $chefs = User::with(['recipes'])->get();
        // dd($chefs);

        return view('chef-list', ['chefs' => $chefs]);
    }
    
    public function login() {

        // dd(url()->previous());
        
        if (Auth::user()) {
            return view('profile', [ // always send user information in
                'user' => Auth::user(),
                'success' => "Successfully signed up!",
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
            
            $userInfo = User::with(['bookmarks', 'recipes'])->find(auth()->id()); // Cleaner for primary key lookup
            $bookmarks = $userInfo->bookmarks;
            // dd($bookmarks);

            return view('profile', [ // always send user information in
                'user' => Auth::user(),
                'bookmarks' => $bookmarks,
                'success' => "Successfully logged in!",
            ]);
        } else { // Invalid credentials
            return view('signup', [
                'error' => "No user found. Please sign up!"
            ]);
        }

    }

    public function signup() {
        if (Auth::user()) {
            return view('profile', [ // always send user information in
                'user' => Auth::user(),
            ]);
        } else { // no one is signed in, sign them up
            return view('signup');
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
            return redirect()->route('login')
                    ->with('error', "That profile has already been taken! Please log in.");
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
                'success' => "Successfully signed up!",
            ]);
        }      
    }

    public function profile() {

        // dd(Auth::user());

        if (Auth::user()) { // if there is a user (someone logged in)

            $userInfo = User::with(['bookmarks', 'recipes'])->find(auth()->id()); // Cleaner for primary key lookup
            $bookmarks = $userInfo->bookmarks;
            // dd($bookmarks);

            return view('profile', [ // always send user information in
                'user' => Auth::user(),
                'bookmarks' => $bookmarks,
            ]);
        } else {
            return view('signup', [
                'error' => "You are not signed in! Please sign up!"
            ]);
        }
    }

    public function logout() {

        // dd(Auth::user());

        Auth::logout();

        return redirect()->route('login')
                ->with('success', "Successfully logged out");
    }
}
