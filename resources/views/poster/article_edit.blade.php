@extends('layouts.master')
@php
$gnavType = -1;
@endphp

@section('content')
    <form action="{{ route('post.update', ['post' => $article->id]) }}" method="post">
        @csrf
        @method('patch')
        @php
            $default_check = $article->status;
        @endphp
        @include('poster.formParts.status_radio')
        <textarea name="title" id="" cols="30" rows="1" required>{{ $article->title }}</textarea>
        <textarea name="content" id="" cols="200" rows="20" required>{{ $article->content }}</textarea>
        <button type="button" onclick="javascript:history.back();">戻る</button>
        <button type="submit">更新</button>
    </form>
@endsection
