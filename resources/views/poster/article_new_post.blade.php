@extends('layouts.master')
@php
$gnavType = -1;
@endphp

@section('content')
    <form action="{{ route('post.create') }}" method="get">
        @csrf
        @include('poster.formParts.status_radio', ['checked' => config('const.common.ARTICLE.DEFAULT_STATUS')])
        <textarea name="title" id="" value="{{ old('title') }}" cols="30" rows="1" required
            placeholder="タイトルを入力してご覧"></textarea>
        <textarea name="content" id="" value="{{ old('content') }}" cols="200" rows="20" required
            placeholder="打てよ・・・"></textarea>
        <button type="button" onclick="javascript:history.back();">戻る</button>
        <button type="submit">投稿</button>
    </form>
@endsection
