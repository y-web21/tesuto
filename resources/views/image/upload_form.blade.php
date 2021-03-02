@extends('layouts.master')
@php
$disp_gnav = config('const.common.BLADE.GNAV.DISABLE');
$disp_header = config('const.common.BLADE.HEADER.DISABLE');
@endphp


@section('content')

    <div class="bg-gray-200 sticky top-0 text-black text-center w-full-vw mb-6 z-40">

        <form class="p-5 souko" action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input class="" type="file" name="image" accept="image/png, image/jpeg">
            {{-- <input type="file" name="image" accept="image/*"> --}}
            @error('image')
                {{ $message }}
            @enderror
            <button type="submit"
                class="focus:outline-none text-gray-800 bg-gray-100 text-sm py-1.5 px-3 rounded-sm border border-gray-600 hover:bg-gray-50">アップロード</button>
        </form>
    </div>

    <div class="w-full relative mt-4 shadow-2xl rounded my-24 overflow-hidden">
        <div class="grid grid-cols-12 bg-white">

            @include('poster.parts.side_nav_left')

            <div
                class="col-span-12 md:border-solid md:border-l md:border-black md:border-opacity-25 h-full pb-12 md:col-span-10">
                <div class="px-4 py-6">

                    @error('page')
                        <p class="text-red-900">
                            {{ $message }}
                        </p>
                    @enderror

                    @foreach ($images as $image)
                        <div style="display:inline-block;">
                            <figure style="">
                                <a href="{{ route('image.show', $image->id) }}"><img width=200
                                        src="{{ asset('/storage/images/' . $image->name) }}"
                                        alt="{{ $image->description }}"></a>
                                <figcaption>{{ $image->description }}</figcaption>
                            </figure>
                            <form action={{ route('image.del-req') }} method="post" style="display:inline-block;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $image->id }}">
                                <button type="submit"
                                    class="focus:outline-none text-red-800 bg-gray-100 text-sm py-1.5 px-3 rounded-sm border border-red-600 hover:bg-red-50">削除</button>
                            </form>
                        </div>
                    @endforeach
                </div>
                {{ $images->links('layouts.paginator.default') }}
            </div>
        </div>
    </div>

@endsection
