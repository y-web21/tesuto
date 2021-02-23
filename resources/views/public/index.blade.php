@extends('layouts.master')
@section('title', 'home')

@php
$disp_header = config('const.common.BLADE.HEADER.LARGE');
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
