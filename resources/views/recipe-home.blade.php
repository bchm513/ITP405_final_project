@extends('layout')

@section('title', 'Recipe Home')

@section('main')

<h1>Recipe List</h1>
{{-- {{ dd($recipes) }} --}}
<h3><a href="{{ route('create-recipe') }}">Create Recipe</a></h3>

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

<table class="table table-striped">
    <thead>
        <tr>
           <td><b>Recipe</b></td>
           <td><b>Chef</b></td>
           <td><b>Category</b></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($recipes as $recipe)
            <tr>
                <td><a href="{{ route('recipe-details', ['id' => $recipe->id]) }}">{{ $recipe->title }}</a></td>
                <td><a href="{{ route('chef-details', ['id' => $recipe->user_id]) }}">{{ $recipe->user->name }}</a></td>
                <td><a href="{{ route('category-details', ['id' => $recipe->category_id]) }}">{{ $recipe->category->name }}</a></td>
                @if (Auth::user())
                    <td><a href="{{ route('createBookmarks', ['userId' => Auth::user()->id, 'recipeId' => $recipe->id]) }}">Add Bookmark!</a></td>                    
                @endif
            </tr>
        @endforeach
    </tbody>
</table>