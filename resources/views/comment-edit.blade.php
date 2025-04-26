@extends('layout')

@section('title', 'Profile')

@section('main')
<div class="container">
    {{-- {{ dd($comment) }} --}}

    <h1>Edit Comment</h1>
    <h3>{{ $comment->recipe->title }}</h3>

    <form method="POST" action="{{ route('edit-comment') }}">
        @csrf
        
        {{-- content --}}
        <div>
            <textarea name="content" required>{{ old('content', $comment->content ?? '') }}</textarea>
        </div>
        
        {{-- star rating --}}
        <div>
            @for($i = 1; $i <= 5; $i++)
                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating', $comment->rating) == $i ? 'checked' : '' }}>
                <label for="star{{ $i }}">★</label>
            @endfor
        </div>

        {{-- hidden comment id --}}
        <input type="hidden" name="comment_id" value="{{ $comment->id }}">

        {{-- hidden recipe id --}}
        <input type="hidden" name="recipe_id" value="{{ $comment->recipe->id }}">
        
        <button type="submit">Submit</button>
    </form>
</div>