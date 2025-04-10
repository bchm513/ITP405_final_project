@extends('layout')

@section('title', 'Sign Up')

@section('main')
<div style="padding: 20px;">
    <h1>Sign Up</h1>
    <div style="padding: 20px;">
        <form action="{{ route('signupForm') }}" method="POST">
            @csrf
            <label for="content" class="form-label">Input User Information</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error ('name') 
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
            @error ('email') 
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <input type="text" name="password" id="password" class="form-control" value="{{ old('password') }}">
            @error ('password') 
                <small class="text-danger">{{ $message }}</small> 
            @enderror

            <label for="content" class="form-label"></label>
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </form>
    </div>
</div>