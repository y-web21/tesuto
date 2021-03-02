@php
$poster_nav = [[route('post.new_post'), '新規投稿'], [route('image.upload_form'), '画像アップローダ'], [route('post.index'), '記事一覧']];
@endphp

<div
    class="col-span-12 w-full px-3 py-6 justify-center flex space-x-4 border-b border-solid md:space-x-0 md:space-y-4 md:flex-col md:col-span-2 md:justify-start ">
    @foreach ($poster_nav as $item)
        @if (request()->url() === $item[0])
            <a href="{{ $item[0] }}"
                class="text-sm p-2 bg-indigo-900 text-white text-center rounded font-bold pointer-events-none">{{ $item[1] }}</a>
        @else
            <a href="{{ $item[0] }}"
                class="text-sm p-2 bg-indigo-200 text-center rounded font-semibold hover:bg-indigo-700 hover:text-gray-200">{{ $item[1] }}</a>
        @endif
    @endforeach
</div>
