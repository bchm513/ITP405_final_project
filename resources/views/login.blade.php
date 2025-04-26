@extends('layout')

@section('title', 'Login')

@section('main')
<div class="container">
    @if (session('error')) {{-- if the success variable we made in controller has session data, print out the stuff in the div below --}}
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success')) {{-- if the success variable we made in controller has session data, print out the stuff in the div below --}}
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div style="padding: 20px;">
        <h1>Login</h1>
        <div style="padding: 20px;">
            <form action="{{ route('loginForm') }}" method="POST">
            <div>
                @csrf
                <label for="content" class="form-label">Input User Information</label>

                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                <label for="email" class="form-label">Email</label>
                @error ('email') 
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <input type="text" name="password" id="password" class="form-control" value="{{ old('password') }}">
                <label for="password" class="form-label">Password</label>
                @error ('password') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
                
            </div>
            <div>
                <button type="submit" class="btn btn-primary">
                    Log In
                </button>
            <div>
            </form>
        </div>
    </div>
</div>