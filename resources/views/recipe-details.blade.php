@extends('layout')

@section('title', 'Recipe Details')

@section('main')
<div class="container">
    {{-- basic recipe info --}}
    <h1>Recipe Details</h1>
    <h2>{{ $recipe->title }}</h2>
    <h5>{{ $recipe->description }}</h5>

    {{-- more recipe info --}}
    <h5>Ingredients: </h5>
    <p>{{ $recipe->ingredients }}</p>
    <h5>Instructions: </h5>
    <p>{{ $recipe->instructions }}</p>
    <h5>Preparation Time: </h5>
    <p>{{ $recipe->preparation_time }} minutes</p>

    {{-- comments section --}}
    <h2>Comments: </h2>
    {{-- {{ dd($comments); }} --}}
    @if (count($comments) > 0)
        @foreach ($comments as $comment)
            <p>{{ $comment->rating }} &#9733 {{ $comment->content }} --<b>{{ $comment->user->name }}</b>, {{ new DateTime($comment->created_at)->format('H:i m-d-Y') }}</p>
        @endforeach
    @else
        <p>No Comments Yet!</p>
    @endif

    @if (Auth::user())
            <h5><a href={{ route('go-to-add-comment', ['userId' => Auth::user()->id, 'recipeId' => $recipe->id]) }}>Add a comment!</a></h5>
        @else
            <h5>Want to add a comment? <a href={{ route('signup') }}>Sign up!</a></h5>
        @endif

    {{-- bookmark opportunity --}}
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
</div>