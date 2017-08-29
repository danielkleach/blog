@extends('layout.master')

@section('content')
    <main>
        <div class="article-single">
            <span class="subject">{{ $post->subject->name }}</span>
            <h2 class="title"><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h2>
            <span class="date">{{ $post->formatted_date }}</span>
            <div class="content">
                <p>{{ $post->content }}</p>
            </div>
        </div>
    </main>
@endsection