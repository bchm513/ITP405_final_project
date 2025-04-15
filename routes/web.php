<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookmarkController;


Route::get('/', function () {
    return view('welcome');
});

// recipes
Route::get('/recipe-home', [RecipeController::class, 'index'])->name('recipe-home');
Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipe-details');
Route::get('/create-recipe', [RecipeController::class, 'goToCreate'])->name('create-recipe');

// chefs
Route::get('/chefs', [UserController::class, 'chefList'])->name('chefList');
Route::get('/chef-details/{id}', [UserController::class, 'show'])->name('chef-details');

// categories
Route::get('/categories', [CategoryController::class, 'categoryList'])->name('categoryList');
Route::get('/category-details/{id}', [CategoryController::class, 'show'])->name('category-details');

// bookmarks
Route::get('/createBookmarks/userId={userId}+recipeId={recipeId}', [BookmarkController::class, 'createBookmarks'])->name('createBookmarks');
Route::get('/deleteBookmarks/userId={userId}+recipeId={recipeId}', [BookmarkController::class, 'deleteBookmarks'])->name('deleteBookmarks');

// sign/log in
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/signup', [UserController::class, 'signup'])->name('signup');
Route::post('/signupForm', [UserController::class, 'signupForm'])->name('signupForm');
Route::post('/loginForm', [UserController::class, 'loginForm'])->name('loginForm');

// log out
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// profile
Route::get('/profile', [UserController::class, 'profile'])->name('profile');