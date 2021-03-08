@extends('layouts.master')
@section('title', 'Fictitious companany')

    @php
    $disp_header = config('const.common.BLADE.HEADER.LARGE');
    @endphp

@section('content')

    <div class="grid grid-cols-12 gap-7 mx-auto">

        <div class="col-span-12 xl:col-span-9 mt-10">

            <section class="lg:grid lg:grid-cols-3 gap-4 w-full">
                <div
                    class="lg:col-span-2 bg-white border-2 border-gray-300 rounded-md tracking-wide break-all shadow-lg w-full p-4 h-100per">
                    @if ($top_news !== null)
                        <a class="flex flex-wrap justify-between"
                            href={{ route('article.show', ['article' => $top_news->id]) }}>
                            <div class="flex flex-col px-3 w-2/3">
                                <h3 class="text-xl font-semibold overflow-hidden">{{ Helper::strlimit($top_news->title, 50) }}</h3>
                                <p class="text-gray-800 overflow-hidden mt-2">
                                    {{ Helper::strlimit($top_news->content, 150) }}</p>
                                <p class="text-sm ml-auto mt-auto">{{ $top_news->created_at }}</p>
                            </div>
                            @if ($top_news->uploadImage === null)
                                <img alt="no_image" class="rounded-md border-2 border-gray-300 object-cover w-1/3 h-200px"
                                    src=" {{ asset('storage/images/no_image.png') }}">
                            @else
                                <img alt="{{ $top_news->uploadImage->description }}"
                                    class="rounded-md border-2 border-gray-300 object-cover w-1/3 h-200px"
                                    src="{{ asset('storage/images/' . $top_news->uploadImage->name) }}">
                            @endif
                        </a>
                    @else
                        <p>no posts.</p>
                    @endif
                </div>
                <div
                    class="lg:col-span-1 bg-white border-2 border-gray-300 rounded-md tracking-wide shadow-lg p-5 mt-10 lg:mt-0 h-100per">
                    {{ 'void' }}
                </div>
            </section>

            <section class="grid grid-cols-1 lg:grid-cols-2 gap-7 w-full mt-10">
                @foreach ($articles as $article)
                    <div class="bg-white border-2 border-gray-300 rounded-md tracking-wide break-all shadow-lg w-full p-4">
                        <a class="flex flex-wrap justify-between"
                            href={{ route('article.show', ['article' => $article->id]) }}>
                            <div class="flex flex-col px-3 w-2/3">
                                <h3 class="text-xl font-semibold overflow-hidden">{{ Helper::strlimit($article->title, 30) }}</h3>
                                <p class="text-gray-800 overflow-hidden mt-2">
                                    {{ Helper::strlimit($article->content, 50) }}</p>
                                <p class="text-sm ml-auto mt-auto">{{ $article->created_at }}</p>
                            </div>
                            @if ($article->uploadImage === null)
                                <img alt="no_image" class="rounded-md border-2 border-gray-300 object-contain w-1/3 h-150px"
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

        </div>
        <div class="col-span-12 xl:col-span-3 mt-10">
            @include('layouts.side_content')
        </div>
    </div>

@endsection
