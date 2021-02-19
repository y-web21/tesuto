@extends('layouts.master')
@php
$gnavType = -1;
@endphp


@section('content')
    <b>your name = {{ $user_name }} , id = {{ $user_id }}</b><br>
    <b>your posts = {{ $articles->count() }}</b><br>
    <a href="{{ route('post.newPost') }}">新規作成</a>
    @foreach ($articles as $article)
        <br>
        {{ $article->title }}
        <br>
        {{ Helper::strlimit($article->content, 50) }}
        <br>
        {{ $article->status_name }}
        <br>
        {{ $article->created_at }}
        <br>
        {{ $article->updated_at }}
        <br>
        <button type="button" onclick="location.href='{{ route('post.edit', ['post' => $article->id]) }}'">編集</button>
        <form action={{ route('post.destroy', ['post' => $article->id]) }} method="post">
            @csrf
            @method('delete')
            {{-- <button type="submit" onclick="location.href=''">削除</button> --}}
            <button type="submit">削除</button>
        </form>
        <br>
    @endforeach
@endsection

@php
echo url()->previous('/error');

echo url()->previous('/error');
@endphp
