@extends('layout.master')

@section('twitter')
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@danielkleach">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->description }}">
    <meta name="twitter:image" content="{{ $post->preview_image_url }}">
    <meta name="twitter:creator" content="@danielkleach">
@endsection

@section('content')
    <main>
        <div class="article-single">
            <span class="subject">{{ $post->subject->name }}</span>
            <h2 class="title"><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h2>
            <span class="date">{{ $post->formatted_date }}</span>
            <div class="content">
                {!! $post->content !!}
            </div>
        </div>
    </main>
@endsection