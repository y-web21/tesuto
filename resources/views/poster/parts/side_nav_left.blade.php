<div
class="col-span-12 w-full px-3 py-6 justify-center flex space-x-4 border-b border-solid md:space-x-0 md:space-y-4 md:flex-col md:col-span-2 md:justify-start ">

<a href="{{ route('post.new_post') }}"
    class="text-sm p-2 bg-indigo-900 text-white text-center rounded font-bold">
    新規投稿</a>

<a href="{{ route('image.upload_form') }}"
    class="text-sm p-2 bg-indigo-200 text-center rounded font-semibold hover:bg-indigo-700 hover:text-gray-200">
    画像アップローダ</a>

<a href="{{ route('post.index') }}"
    class="text-sm p-2 bg-indigo-200 text-center rounded font-semibold hover:bg-indigo-700 hover:text-gray-200">
    記事一覧</a>
</div>
