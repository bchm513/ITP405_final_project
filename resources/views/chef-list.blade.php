@extends('layout')

@section('title', 'Chef List')

@section('main')
<div class="container">
    <h1>Chef List</h1>
    {{-- {{ dd($chefs) }} --}}
    <table class="table table-striped">
        <tbody>
            @foreach ($chefs as $chef)
            {{-- {{ dd($chef); }} --}}
                <tr>
                    <td><a href="{{ route('chef-details', ['id' => $chef->id]) }}">{{ $chef->name }}</a></td>
                </tr>
                {{-- {{ dd($chef->recipes); }} --}}
                @foreach($chef->recipes as $recipe)
                <tr>
                    {{-- {{ dd($recipe) }} --}}
                    <td style="padding-left: 20px;"><a href="{{ route('recipe-details', ['id' => $recipe->id]) }}">{{ $recipe->title }}</a>
                        : {{ $recipe->description }}
                    </td>
                    
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>