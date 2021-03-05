@php
if (isset($image) && $image->count() !== 0) {
    $image_id = $image->id;
} else {
    $image_id = 0;
}

$form_value = [];
$form_value['status_id'] = config('const.common.ARTICLE.DEFAULT_STATUS');

if (isset($article)) {
    $form_value += ['title' => $article->title];
    $form_value += ['content' => $article->content];
    $form_value['status_id'] = $article->status;
}

// session変数を優先
Session::has('editing_title') && ($form_value = Helper::arrayAppendOrOverwrite($form_value, 'title', Session::get('editing_title')));
Session::has('editing_content') && ($form_value = Helper::arrayAppendOrOverwrite($form_value, 'content', Session::get('editing_content')));
Session::has('editing_status') && ($form_value = Helper::arrayAppendOrOverwrite($form_value, 'status_id', Session::get('editing_status')));

// 'new' or 'edit'
!isset($mode) && ($mode = 'new');

@endphp

<div class="px-4 py-6">
    <div>
        <h3 class="text-2xl font-semibold">{{ $mode === 'edit' ? '編集' : '新規作成' }}</h3>
        <hr>
    </div>

    <form class="flex flex-col space-y-8">
        @csrf

        <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4">

            <div class="w-full">
                <label class="text-xl ">タイトル</label>
                <input id="new_title" type="text" name="title"
                    value="{{ isset($form_value['title']) ? $form_value['title'] : old('title') }}"
                    placeholder="タイトルを入力してください" class="w-full form-active-blue text-opacity-10">
            </div>

            <div class="w-full">
                <label class="text-xl ">投稿者</label>
                <input type="author" value="{{ 'getPosterName' }}" class="w-full form-active-blue text-opacity-10"
                    disabled>
            </div>
        </div>

        <div class="w-full">
            <label class="text-xl bg-">投稿内容</label>
            <textarea id="new_content" name="content" cols="30" rows="10" placeholder="内容を入力してください"
                class="w-full form-active-blue text-opacity-10">{{ isset($form_value['content']) ? $form_value['content'] : old('content') }}</textarea>
        </div>

        <div class="w-full">
            @include('poster.parts.radio_status', ['checked' => (int)($form_value['status_id']) ])
        </div>

        <hr>

        <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:space-x-4 gap-4">
            <div class="flex w-full justify-around">

                <input type="hidden" name="image_id" value="{{ $image_id }}">

                <div class="flex items-center justyfy-center">
                    @if ($mode === 'edit')
                        <button id="btn_submit_update" type="submit" formmethod="post"
                            formaction="{{ route('post.update', ['post' => $article->id]) }}"
                            class="btn-green">更新</button>
                    @else
                        <button id="btn_submit_new_post" type="submit" formmethod="get"
                            formaction="{{ route('post.create') }}" class="btn-blue">投稿</button>
                    @endif
                </div>

                <div class="flex items-center justyfy-center">
                    <button id="btn_submit_select_image" type="submit" formmethod="post"
                        formaction="{{ route('post.tempsave') }}" class="btn-gray">画像を選択</button>
                </div>
                <div class="flex items-center justyfy-center"><button type="button" onclick="javascript:history.back();"
                        class="btn-gray">戻る</button></div>
            </div>

            <div class="w-full">
                @if (isset($image) && $image->count() !== 0)
                    <label class="text-xl bg-">投稿画像</label>
                    <img src="{{ asset('/storage/images/' . $image->name) }}" alt="{{ $image->description }}"
                        class="w-full mw-300px mx-auto">
                @endif

            </div>
        </div>
    </form>
</div>
