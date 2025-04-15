@extends('layout')

@section('title', 'Profile')

@section('main')

<h1>Hello {{ $user->name }}!</h1> 

<p>Email: {{ $user->email }}</p>
<p><a href="{{ route('logout') }}">Log Out</a></p>

<h2>Bookmarks</h2>
{{-- {{ dd($bookmarks); }} --}}
@if ($bookmarks->isEmpty()) {{-- if the user has no bookmarks --}}
    <p>You have no bookmarks! <a href="{{ route('recipe-home') }}">Go to Recipes</a></p>   
@else
    @foreach ($bookmarks as $bookmark)
        <h5><a href="{{route('recipe-details', ['id' => $bookmark->id]) }}">{{ $bookmark->title }}</a></h5>
        <p><a href="{{ route('deleteBookmarks', ['userId' => Auth::user()->id, 'recipeId' => $bookmark->id]) }}">Delete Bookmark</a></p>
    @endforeach
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

