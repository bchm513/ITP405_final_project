@extends('layout')

@section('title', 'Profile')

@section('main')
<div class="container">
    <h1>Hello {{ $user->name }}!</h1> 

    <p>Email: {{ $user->email }}</p>
    <p><a href="{{ route('logout') }}">Log Out</a></p>

    <h2>My Recipes</h2>
    {{-- {{ dd($recipes); }} --}}

    @if ($recipes->isEmpty()) {{-- if the user has no bookmarks --}}
        <p>You have no recipes! <a href="{{ route('create-recipe') }}">Go to Recipes</a></p>   
    @else
        @foreach ($recipes as $recipe)
            <h5><a href="{{route('recipe-details', ['id' => $recipe->id]) }}">{{ $recipe->title }}</a></h5>
            <p><a href="{{route('go-to-edit-recipe', ['id' => $recipe->id]) }}">Edit Recipe</a></p>
            <p><a href="{{route('delete-recipe', ['id' => $recipe->id]) }}">Delete Recipe</a></p>
        @endforeach
    @endif

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

    <h2>Comments</h2>
    {{-- {{ dd($comments); }} --}}

    @if ($comments->isEmpty()) {{-- if the user has no bookmarks --}}
        <p>You have no comments! <a href="{{ route('recipe-home') }}">Go to Recipes</a></p>   
    @else
        {{-- {{ dd($comments) }} --}}
        @foreach ($comments as $comment)
            <h5><a href="{{route('recipe-details', ['id' => $comment->recipe_id]) }}">{{ $comment->rating }} &#9733 {{ $comment->recipe->title }}: {{ $comment->content }}</a></h5>
            <p><a href="{{ route('go-to-edit-comment', ['userId' => Auth::user()->id, 'commentId' => $comment->id]) }}">Edit Comment</a></p>
            <p><a href="{{ route('deleteComments', ['commentId' => $comment->id]) }}">Delete Comment</a></p>
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
</div>