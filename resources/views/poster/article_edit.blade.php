@extends('layouts.master')
@php
$disp_gnav = config('const.common.BLADE.GNAV.DISABLE');
@endphp

@section('content')
    <form>
        @csrf
        @include('poster.parts.radio_status',['checked' => $article->status])
        <textarea name="title" id="" cols="30" rows="1" required>{{ $article->title }}</textarea>
        <textarea name="content" id="" cols="200" rows="20" required>{{ $article->content }}</textarea>
        <button type="button" onclick="javascript:history.back();">戻る</button>
        <button type="submit" id="btn_submit_edit_confirm" formmethod="post" formaction="{{ route('post.update', ['post' => $article->id]) }}">更新</button>
        {{-- <button type="submit" id="btn_submit_edit_image_select" formmethod="post" formaction="{{ route('post.tempsave') }}" class="btn-gray">画像を選択</button> --}}
        <div class="flex items-center justyfy-center">
            <button id="btn_submit_select_image" type="submit" formmethod="post" formaction="{{ route('post.tempsave') }}"
                class="btn-gray">画像を選択</button>
        </div>
    </form>
    @if (isset($image) && $image->count() !== 0)
        <img width=200 src="{{ asset('/storage/images/' . $image->name) }}" alt="{{ $image->description }}">
    @endif

@endsection
