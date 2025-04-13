@extends('layout')

@section('title', 'Chef Details')

@section('main')

<h1>{{ $chefInfo->name }}</h1>

@if ($chefInfo->recipes) {{-- if the chef (user) has recipes, start the for loop --}}
    
    <h3>Recipes:</h3>
    {{-- {{ dd($chefInfo->recipes) }} --}}
    <table class="table table-striped">
        @foreach ($chefInfo->recipes as $recipe)
            <tr>
                <td><a href="{{ route('recipe-details', ['id' => $recipe->id]) }}">{{ $recipe->title }}</a>: {{ $recipe->description }}</td>
                <td>Category: <a href="{{ route('category-details', ['id' => $recipe->category_id]) }}">{{ $recipe->category->name }}</a></td>
            </tr>
        @endforeach
    </table>

 @else  {{-- if the chef (user) does not have recipes, tell the reader --}}
    <h3>This chef has no recipes!</h3>
    <h5><a href="{{ route('create-recipe') }}">Create Recipe</a></h5>
 
@endif

