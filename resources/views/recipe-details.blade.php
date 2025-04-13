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

{{-- {{ dd($recipe) }} --}}
