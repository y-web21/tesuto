@extends('layouts.master')
@section('title', 'Fictitious companany')

    @php
    $disp_header = config('const.common.BLADE.HEADER.LARGE');
    @endphp

@section('content')

    <div class="grid grid-cols-12 gap-7 mx-auto">

        <div class="col-span-12 xl:col-span-9 mt-10">

            <section class="lg:grid lg:grid-cols-3 gap-7 w-full">
                <div
                    class="lg:col-span-2 bg-white border-2 border-gray-300 rounded-md tracking-wide break-all shadow-md w-full px-4 h-100per hover:bg-gray-100 hover:shadow-lg">
                    @if ($top_news !== null)
                        <a class=""
                            href={{ route('article.show', ['article' => $top_news->id]) }}>
                            <div class="flex flex-wrap md:flex-nowrap justify-center">
                                @if ($top_news->uploadImage === null)
                                    <img alt="no_image"
                                        class="rounded-md border-2 border-gray-300 object-cover sm:w-1/2 xl:w-3/7 mh-400px my-4 bg-white"
                                        src=" {{ asset('storage/images/no_image.png') }}">
                                @else
                                    <img alt="{{ $top_news->uploadImage->description }}"
                                        class="rounded-md border-2 border-gray-300 object-cover sm:w-1/2 xl:w-3/7 mh-400px my-4"
                                        src="{{ asset('storage/images/' . $top_news->uploadImage->name) }}">
                                @endif
                                <div class="flex flex-col my-4 ml-5 mr-2">
                                    <h3 class="text-xl font-semibold overflow-hidden">
                                        {{ Helper::strlimit($top_news->title, 50) }}</h3>
                                    <p class="text-gray-800 overflow-hidden mt-3">
                                        {{ Helper::strlimit($top_news->content, 250) }}</p>
                                    <p class="text-sm ml-auto mt-auto pt-4">{{ $top_news->created_at }}</p>
                                </div>
                            </div>
                        </a>
                    @else
                        <p>no posts.</p>
                    @endif
                </div>
                <div
                    class="lg:col-span-1 bg-white border-2 border-gray-300 rounded-md tracking-wide shadow-md p-4 mt-10 lg:mt-0 h-100per">
                    <div class="flex flex-col px-3 h-100per">
                        <h3 class="text-xl font-semibold overflow-hidden">COVID-19情報({{ $pref_data['name_ja'] }})</h3>
                        <div class="flex justify-around text-gray-800 overflow-hidden">
                            <div class="flex flex-col mt-2">
                                <p class="mt-2">人口</p>
                                <p class="mt-2">入院患者数</p>
                                <p class="mt-2">陽性者</p>
                                <p class="mt-2">退院者</p>
                                <p class="mt-2">PCR検査</p>
                                <p class="mt-2">重患者</p>
                                <p class="mt-2">死亡者数</p>
                            </div>
                            <div class="flex flex-col text-right mt-2">
                                <p class="mt-2">{{ number_format($pref_data['population']) }}人</p>
                                <p class="mt-2">{{ number_format($pref_data['hospitalize']) }}人</p>
                                <p class="mt-2">{{ number_format($pref_data['cases']) }}人</p>
                                <p class="mt-2">{{ number_format($pref_data['discharge']) }}人</p>
                                <p class="mt-2">{{ number_format($pref_data['pcr']) }}人</p>
                                <p class="mt-2">{{ number_format($pref_data['severe']) }}人</p>
                                <p class="mt-2">{{ number_format($pref_data['deaths']) }}人</p>
                            </div>
                        </div>
                        <p class="text-sm ml-auto mt-auto pt-4">最終更新: {{ $covid19_api['updatedAt'] }}</p>
                        <a class="text-xs ml-auto mt-1 hover:opacity-60"
                            href="{{ $covid19_api['poweredByUrl'] }}">powered by {{ $covid19_api['poweredBy'] }}</a>
                    </div>
                </div>
            </section>

            <!-- article cards -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-7 w-full mt-10">
                @foreach ($articles as $article)
                    <div
                        class="bg-white border-2 border-gray-300 rounded-md tracking-wide break-all shadow-md w-full p-4 hover:bg-gray-100 hover:shadow-lg">
                        <a class="flex flex-wrap justify-between"
                            href={{ route('article.show', ['article' => $article->id]) }}>
                            <div class="flex flex-col px-3 w-2/3">
                                <h3 class="text-xl font-semibold overflow-hidden">
                                    {{ Helper::strlimit($article->title, 30) }}</h3>
                                <p class="text-gray-800 overflow-hidden mt-2">
                                    {{ Helper::strlimit($article->content, 50) }}</p>
                                <p class="text-sm ml-auto mt-auto">{{ $article->created_at }}</p>
                            </div>
                            @if ($article->uploadImage === null)
                                <img alt="no_image"
                                    class="rounded-md border-2 border-gray-300 object-contain w-1/3 h-150px bg-white"
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
