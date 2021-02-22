@extends('layouts.master')
@section('title', 'home')

@php
$headerType = 1;
@endphp

@section('content')
    @foreach ($articles as $article)
        {{ $article->title }}
        <br>
        {{ Helper::strlimit($article->content, 50) }}
    @endforeach
@endsection

@section('footer')
    @parent
@endsection
