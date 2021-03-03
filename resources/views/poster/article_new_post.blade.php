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

    <div class="w-full relative mt-4 shadow-2xl rounded my-24 overflow-hidden">


        <div class="grid grid-cols-12 bg-white">

            @include('poster.parts.side_nav_left')

            <div class="col-span-12 md:border-solid md:border-l md:border-black md:border-opacity-25 h-full pb-12 md:col-span-10">
                <div class="px-4 py-6">
                    <div>
                        <h3 class="text-2xl font-semibold">新規作成</h3>
                        <hr>
                    </div>

                    <form class="flex flex-col space-y-8">
                        @csrf

                        <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">

                            <div class="w-full">
                                <label class="text-xl ">タイトル</label>
                                <input id="new_title" type="text" name="title"
                                    value="{{ Session::has('editing_title') ? Session::get('editing_title') : old('title') }}"
                                    placeholder="タイトルを入力してください" class="w-full form-active-blue text-opacity-10">
                            </div>

                            <div class="w-full">
                                <label class="text-xl ">投稿者</label>
                                <input type="author" value="{{ 'getPosterName' }}"
                                    class="w-full form-active-blue text-opacity-10" disabled>
                            </div>
                        </div>

                        <div class="w-full">
                            <label class="text-xl bg-">投稿内容</label>
                            <textarea id="new_content" name="content" cols="30" rows="10" placeholder="内容を入力してください"
                                class="w-full form-active-blue text-opacity-10">{{ Session::has('editing_content') ? Session::get('editing_content') : old('content') }}</textarea>
                        </div>

                        <div class="w-full">
                            @include('poster.parts.radio_status', ['checked' =>
                            config('const.common.ARTICLE.DEFAULT_STATUS')])
                        </div>

                        <hr>

                        <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4 gap-4">
                            <div class="flex w-full justify-around">
                                <input type="hidden" name="image_id" value="{{ $image_id }}">
                                <div class="flex items-center justyfy-center">
                                    <button id="btn_submit_new_post" type="submit" formmethod="get"
                                        formaction="{{ route('post.create') }}" class="btn-blue">投稿</button></div>
                                <div class="flex items-center justyfy-center">
                                    <button id="btn_submit_select_image" type="submit" formmethod="post" formaction="{{ route('post.tempsave') }}"
                                        class="btn-gray">画像を選択</button>
                                </div>
                                <div class="flex items-center justyfy-center"><button type="button"
                                        onclick="javascript:history.back();" class="btn-gray">戻る</button></div>
                                {{-- 画像を選択時は、textareaのrequired属性を外す --}}
                            </div>

                            <div class="w-full">
                                @if (isset($image) && $image->count() !== 0)
                                    <label class="text-xl bg-">投稿画像</label>
                                    <img src="{{ asset('/storage/images/' . $image->name) }}"
                                        alt="{{ $image->description }}" class="w-full mw-300px mx-auto">
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>



@endsection
