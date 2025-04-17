@extends('layout')

@section('title', 'Create Comment')

@section('main')

<h1>Add Comment</h1>
<h3>{{ $recipe->title }}</h3>

<form method="POST" action="{{ route('add-comment') }}">
    @csrf
    
    {{-- content --}}
    <div>
        <textarea name="content" required>{{ old('content') }}</textarea>
    </div>
    
    {{-- star rating --}}
    <div>
        @for($i = 1; $i <= 5; $i++)
            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
            <label for="star{{ $i }}">★</label>
        @endfor
    </div>

    {{-- hidden recipe id --}}
    <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
    
    <button type="submit">Submit</button>
</form>

{{-- {{ dd($recipe, $userId) }} --}}