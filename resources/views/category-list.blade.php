@extends('layout')

@section('title', 'Category List')

@section('main')
<div class="container">
    <h1>Category List</h1>
    {{-- {{ dd($categories) }} --}}
    {{-- <h3><a href="{{ route('create-category') }}">Create Category</a></h3> --}}
    <table class="table table-striped">
        <tbody>
            @foreach ($categories as $category)
            {{-- {{ dd($category); }} --}}
                <tr>
                    <td><a href="{{ route('category-details', ['id' => $category->id]) }}">{{ $category->name }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>