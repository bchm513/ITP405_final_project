@extends('layout')

@section('title', 'Profile')

@section('main')

{{-- {{ dd($user); }} --}}

<h1>Hello {{ $user->name }}!</h1> 

@if (session('error')) {{-- if the success variable we made in controller has session data, print out the stuff in the div below --}}
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

<p>Email: {{ $user->email }}</p>
<p><a href="{{ route('logout') }}">Log Out</a></p>


{{-- list off bookmarks --}}
{{-- list off recipes --}}

