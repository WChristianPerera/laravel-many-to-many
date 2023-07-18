@extends('admin.layouts.base')

@section('contents')

    <h1>{{ $post->title }}</h1>
    <h2>Category: {{ $post->category->name }}</h2>
    <h3>Tags: {{ implode(', ', $post->tags->pluck('name')->all()) }}</h3>

    {{-- <img src="{{ $post->url_image }}" alt="{{ $post->title }}"> --}}

    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
    @endif

    <p>{{ $post->content }}</p>

@endsection