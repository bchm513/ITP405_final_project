<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recipe-home', [RecipeController::class, 'index'])->name('recipe-home');
Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipe-details');
Route::get('/create-recipe', [RecipeController::class, 'goToCreate'])->name('create-recipe');

Route::get('/chef-details', [RecipeController::class, 'chefs'])->name('chef-details');
Route::get('/category-details', [RecipeController::class, 'categories'])->name('category-details');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/signup', [UserController::class, 'signup'])->name('signup');
Route::post('/signupForm', [UserController::class, 'signupForm'])->name('signupForm');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
