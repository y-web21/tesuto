@extends('layouts.master')
@php
$gnavType = -1;
@endphp

@section('content')
    <b>your name = {{ $user_name }} , id = {{ $user_id }}</b><br>
    <b>your posts = {{ $articles->count() }}</b><br>
    <a href="{{ route('post.new-post') }}">新規作成</a>
    <a href="{{ route('image.upload-form') }}">イメージアップローダ</a>

    <table class="table-fixed my-10">
        <thead>
            <tr class="">
                <th class="border border-blue-200 bg-blue-900 text-gray-200 px-4 py-2 font-medium w-2/15">タイトル</th>
                <th class="border border-blue-200 bg-blue-900 text-gray-200 px-4 py-2 font-medium ">内容</th>
                <th class="border border-blue-200 bg-blue-900 text-gray-200 px-4 py-2 font-medium w-1/15">状態</th>
                <th class="border border-blue-200 bg-blue-900 text-gray-200 px-4 py-2 font-medium w-2/15">更新日</th>
                <th class="border border-blue-200 bg-blue-900 text-gray-200 px-4 py-2 font-medium w-2/15">作成日</th>
                <th class="border border-blue-200 bg-blue-900 text-gray-200 px-4 py-2 font-medium w-2/15">ボタン</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td class="border border-blue-800 px-4 py-2 font-medium">{{ $article->title }}</td>
                    <td class="border border-blue-800 px-4 py-2 font-medium">{{ Helper::strlimit($article->content, 50) }}
                    </td>
                    <td class="border border-blue-800 px-4 py-2 font-medium text-center">{{ $article->status_name }}</td>
                    <td class="border border-blue-800 px-4 py-2 font-medium text-center">{{ $article->updated_at }}</td>
                    <td class="border border-blue-800 px-4 py-2 font-medium text-center">{{ $article->created_at }}</td>
                    <td class="border border-blue-800 font-medium text-center">
                        <div class="flex items-center justify-around">
                            <div>
                                <button type="button"
                                class="focus:outline-none text-green-800 bg-gray-100 text-sm py-1.5 px-3 rounded-sm border border-green-600 hover:bg-green-50 "
                                onclick="location.href='{{ route('post.edit', ['post' => $article->id]) }}'">編集</button>
                            </div>
                            <form action={{ route('post.destroy', ['post' => $article->id]) }} method="post"
                                class="m-0">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                class="focus:outline-none text-red-800 bg-gray-100 text-sm py-1.5 px-3 rounded-sm border border-red-600 hover:bg-red-50">削除</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@php
echo url()->previous('/error');

echo url()->previous('/error');
@endphp
