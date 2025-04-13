@extends('layout')

@section('title', 'Category Details')

@section('main')

{{-- {{ dd($categoryInfo) }} --}}

<h1>{{ $categoryInfo->name }}</h1>

@if ($categoryInfo->recipes) {{-- if the category has recipes, start the for loop --}}
    
    <h3>Recipes:</h3>
    {{-- {{ dd($chefInfo->recipes) }} --}}
    <table class="table table-striped">
        @foreach ($categoryInfo->recipes as $recipe)
            <tr>
                <td><a href="{{ route('recipe-details', ['id' => $recipe->id]) }}">{{ $recipe->title }}</a>: {{ $recipe->description }}</td>
                <td>Chef: <a href="{{ route('chef-details', ['id' => $recipe->user->id]) }}">{{ $recipe->user->name }}</a></td>
            </tr>
        @endforeach
    </table>

 @else  {{-- if the chef (user) does not have recipes, tell the reader --}}
    <h3>This category has no recipes!</h3>    
    <h5><a href="{{ route('create-recipe') }}">Create Recipe</a></h5>
 
@endif
