@extends('layouts.master')
@section('title', $article->title )

@section('content')

    <article
        class="bg-white border-2 border-gray-300 rounded-xl tracking-wide shadow-lg w-full overflow-hidden my-10 w-full max-w-screen-lg lg:mx-auto">
        <header>
            @if ($article->uploadImage !== null)
                <img alt="{{ $article->uploadImage->description }}" class="object-cover m-0 w-full h-auto mh-500px"
                    style="border-radius: 0.375rem 0.375rem 0 0"
                    src="{{ asset('storage/images/' . $article->uploadImage->name) }}">
            @endif

            <div class="mx-8 pt-8 pb-4 border-b-2 box-border border-blue-400">
                <h1 class="text-xl font-semibold">{{ $article->title }}</h1>
                <p class="text-sm text-gray-800 text-right">{{ $article->created_at }}</p>
            </div>
        </header>
        <div class="p-8">
            <p class="text-gray-800">{{ $article->content }}</p>
        </div>
    </article>

@endsection
