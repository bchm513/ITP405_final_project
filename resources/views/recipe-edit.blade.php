@extends('layout')

@section('title', 'Edit Recipe')

@section('main')

{{-- {{ dd($recipe) }} --}}

<div class="container">
    <h1>Edit Recipe</h1>

    <form method="POST" action="{{ route('edit-recipe') }}">
        @csrf
        {{-- Hidden id for editing --}}
        <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">

        {{-- Title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Recipe Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                   id="title" name="title" value="{{ old('title', $recipe->title ?? '') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" name="description" rows="3" required>{{ old('description', $recipe->description ?? '') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Ingredients --}}
        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredients (one per line)</label>
            <textarea class="form-control @error('ingredients') is-invalid @enderror" 
                      id="ingredients" name="ingredients" rows="5" required>{{ old('ingredients', $recipe->ingredients ?? '') }}</textarea>
            @error('ingredients')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Instructions --}}
        <div class="mb-3">
            <label for="instructions" class="form-label">Instructions</label>
            <textarea class="form-control @error('instructions') is-invalid @enderror" 
                      id="instructions" name="instructions" rows="5" required>{{ old('instructions', $recipe->instructions ?? '') }}</textarea>
            @error('instructions')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Times and Servings --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="preparation_time" class="form-label">Prep Time (mins)</label>
                <input type="number" class="form-control @error('preparation_time') is-invalid @enderror" 
                       id="preparation_time" name="preparation_time" 
                       value="{{ old('preparation_time', $recipe->preparation_time ?? '') }}" min="0" required>
                @error('preparation_time')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-4">
                <label for="cooking_time" class="form-label">Cook Time (mins)</label>
                <input type="number" class="form-control @error('cooking_time') is-invalid @enderror" 
                       id="cooking_time" name="cooking_time" 
                       value="{{ old('cooking_time', $recipe->cooking_time ?? '') }}" min="0" required>
                @error('cooking_time')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-4">
                <label for="servings" class="form-label">Servings</label>
                <input type="number" class="form-control @error('servings') is-invalid @enderror" 
                       id="servings" name="servings" 
                       value="{{ old('servings', $recipe->servings ?? '') }}" min="1" required>
                @error('servings')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror" 
                    id="category_id" name="category_id" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ old('category_id', $recipe->category_id ?? null) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Edit Recipe</button>
    </form>
</div>
@endsection