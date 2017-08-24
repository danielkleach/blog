@extends('layout.master')

@section('content')
    <main>
        @foreach ($latestPosts as $post)
            <div class="article-block">
                <span class="subject"><a href="{{ route('subject.show', $post->subject->slug) }}">{{ $post->subject->name }}</a></span>
                <h2 class="title"><a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h2>
                <span class="date">{{ $post->formatted_date }}</span>
                <div class="content">
                    <p>{{ $post->content }}</p>
                </div>
                <span class="read-more"><a href="{{ route('post.show', $post->slug) }}">Read More</a></span>
            </div>
        @endforeach
    </main>
@endsection

@section('scripts')
    <script src="/js/app.js"></script>
@endsection