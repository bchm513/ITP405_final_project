@extends('layout')

@section('title', 'Recipe Details')

@section('main')

<h1>Recipe Details</h1>

<h2>{{ $recipe->title }}</h2>
<h5>{{ $recipe->description }}</h5>

<h5>Ingredients: </h5>
<p>{{ $recipe->ingredients }}</p>
<h5>Instructions: </h5>
<p>{{ $recipe->instructions }}</p>
<h5>Preparation Time: </h5>
<p>{{ $recipe->preparation_time }} minutes</p>

@if (Auth::user()) {{-- if there is a user --}}
    <h5><a href="{{ route('createBookmarks', ['userId' => Auth::user()->id, 'recipeId' => $recipe->id]) }}">Add Bookmark!</a></h5>
@else {{-- if there is no user --}}
    <h5>Want to bookmark? <a href={{ route('signup') }}>Sign up!</a></h5>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- {{ dd(Auth::user()->id) }} --}}
