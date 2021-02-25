@extends('layouts.master')
@php
$disp_gnav = config('const.common.BLADE.GNAV.DISABLE');
@endphp

@php
if (isset($image) && $image->count() !== 0) {
    $image_id = $image->id;
} else {
    $image_id = 0;
}

@endphp

@section('content')
    <form>
        @csrf
        @include('poster.formParts.status_radio', ['checked' => config('const.common.ARTICLE.DEFAULT_STATUS')])
        <textarea name="title" cols="30" rows="1"
            placeholder="タイトルを入力してご覧">{{ Session::has('editing_title') ? Session::get('editing_title') : old('title') }}</textarea>
        <textarea name="content" cols="200" rows="20"
            placeholder="打てよ・・・">{{ Session::has('editing_content') ? Session::get('editing_content') : old('content') }}</textarea>
        <input type="hidden" name="image_id" value="{{ $image_id }}">
        <button type="button" onclick="javascript:history.back();">戻る</button>
        <button type="submit" formmethod="get" formaction="{{ route('post.create') }}">投稿</button>
        {{-- 画像を選択時は、textareaのrequired属性を外す --}}
        <button type="submit" formmethod="post"formaction="{{ route('post.tempsave') }}">画像を選択</button>
    </form>
    @if (isset($image) && $image->count() !== 0)
        <img width=200 src="{{ asset('/storage/images/' . $image->name) }}" alt="{{ $image->description }}">
    @endif

@endsection
