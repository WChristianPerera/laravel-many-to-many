@extends('admin.layouts.base')

@section('contents')

    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    <h2>Latest posts in this category</h2>
    <ul>
        @foreach ($category->posts()->orderBy('created_at', 'DESC')->limit(3)->get() as $post)
            <li><a href="{{ route('admin.posts.show', ['post' => $post]) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul>

@endsection