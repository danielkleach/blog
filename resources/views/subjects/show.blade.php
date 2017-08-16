@extends('layout.master')

@section('content')
    <h1>{{ $subject->name }}</h1>
    <p>{{ $subject->slug }}</p>
@endsection