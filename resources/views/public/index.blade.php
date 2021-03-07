@extends('layouts.master')
@section('title', 'Fictitious companany')

    @php
    $disp_header = config('const.common.BLADE.HEADER.LARGE');
    @endphp

@section('content')

    <section class="lg:grid lg:grid-cols-3 gap-4 w-full">
        <div class="lg:col-span-2 bg-white border-2 border-gray-300 rounded-md tracking-wide shadow-lg w-full p-5 h-100per">
            @if ($top_news !== null)
                <a class="flex justify-between" href={{ route('article.show', ['article' => $top_news->id]) }}>
                    <div class="flex flex-col mx-5">
                        <h3 class="text-xl font-semibold mb-2">{{ $top_news->title }}</h3>
                        <p class="text-gray-800 mt-2">{{ Helper::strlimit($top_news->content, 150) }}</p>
                        <p class="ml-3 mt-auto">{{ $top_news->created_at }}</p>
                    </div>
                    @if ($top_news->uploadImage === null)
                        <img alt="no_image" class="rounded-md border-2 border-gray-300 object-cover w-200px h-200px"
                            src=" {{ asset('storage/images/no_image.png') }}">
                    @else
                        <img alt="{{ $top_news->uploadImage->description }}"
                            class="rounded-md border-2 border-gray-300 object-cover w-200px h-200px"
                            src="{{ asset('storage/images/' . $top_news->uploadImage->name) }}">
                    @endif
                </a>
            @else
                <p>no posts.</p>
            @endif
        </div>
        <div
            class="lg:col-span-1 bg-white border-2 border-gray-300 rounded-md tracking-wide shadow-lg p-5 my-10 lg:my-0 h-100per">
            {{ 'void' }}
        </div>
    </section>

    <section class="grid sm:grid-cols-1 gap-7 lg:grid-cols-2 w-full my-10">
        @foreach ($articles as $article)
            <div class="bg-white border-2 border-gray-300 rounded-md tracking-wide shadow-lg w-full p-5">
                <a class="flex justify-between" href={{ route('article.show', ['article' => $article->id]) }}>
                    <div class="flex flex-col mx-5">
                        <h3 class="text-xl font-semibold mb-2">{{ $article->title }}</h3>
                        <p class="text-gray-800 mt-2">{{ Helper::strlimit($article->content, 50) }}</p>
                        <p class="ml-3 mt-auto">{{ $article->created_at }}</p>
                    </div>
                    @if ($article->uploadImage === null)
                        <img alt="no_image" class="rounded-md border-2 border-gray-300 object-cover w-150px h-150px"
                            src=" {{ asset('storage/images/no_image.png') }}">
                    @else
                        <img alt="{{ $article->uploadImage->description }}"
                            class="rounded-md border-2 border-gray-300 object-cover w-1/3 h-150px"
                            src="{{ asset('storage/images/' . $article->uploadImage->name) }}">
                    @endif
                </a>
            </div>
        @endforeach
    </section>

@endsection
