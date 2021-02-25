@extends('layouts.master')
@php
$disp_gnav = config('const.common.BLADE.GNAV.DISABLE');
@endphp

@section('content')

    @error('page')
        <p class="text-red-900">
            {{ $message }}
        </p>
    @enderror

    @foreach ($images as $image)


        <div style="display:inline-block;">
            <form action={{ route('post.new_post_image') }} method="post" style="display:inline-block;">
                @csrf
                <figure style="">
                    {{-- <a href="{{ route('post.new_post', $image->id) }}"> --}}
                    <img width=200 src="{{ asset('/storage/images/' . $image->name) }}" alt="{{ $image->description }}">
                    {{-- </a> --}}
                    <figcaption>{{ $image->description }}</figcaption>
                </figure>
                <input type="hidden" name="image" value="{{ $image->name }}">
                <button type="submit"
                    class="focus:outline-none text-red-800 bg-gray-100 text-sm py-1.5 px-3 rounded-sm border border-red-600 hover:bg-red-50">選択</button>

            </form>
        </div>
    @endforeach

    {{ $images->links('layouts.paginator.default') }}

@endsection
