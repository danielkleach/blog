@extends('layout.master')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->slug }}</p>
    <p>{{ $post->content }}</p>
    <p>{{ $post->formatted_date }}</p>
@endsection