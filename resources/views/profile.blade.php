@extends('layout')

@section('title', 'Profile')

@section('main')

{{-- {{ dd($user); }} --}}

<h1>Hello {{ $user->name }}!</h1> 

<p>Email: {{ $user->email }}</p>
<p><a href="{{ route('logout') }}">Log Out</a></p>


{{-- list off bookmarks --}}
{{-- list off recipes --}}

