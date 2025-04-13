@extends('layout')

@section('title', 'Recipe Home')

@section('main')

<h1>Recipe List</h1>
{{-- {{ dd($recipes) }} --}}
<h3><a href="{{ route('create-recipe') }}">Create Recipe</a></h3>
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
            </tr>
        @endforeach
    </tbody>
</table>