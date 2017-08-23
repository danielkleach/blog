@extends('layout.master')

@section('content')
    @foreach ($posts as $post)
        <div class="article-block">
            <span class="subject"><a href="{{ route('subject.show', $post->subject->id) }}">{{ $post->subject->name }}</a></span>
            <h2 class="title"><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></h2>
            <span class="date">{{ $post->formatted_date }}</span>
            <div class="content">
                <p>{{ $post->content }}</p>
            </div>
            <span class="read-more"><a href="{{ route('post.show', $post->id) }}">Read More</a></span>
        </div>
    @endforeach
@endsection