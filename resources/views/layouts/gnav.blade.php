@php
$dum = 'ログイン';
$navList = [['HOME', '/'], ['NEWS', '/news'], ['CATEGORY', '/category'], ['RANKING', '/ranking'], ['ABOUT', '/about'], ['コンスタンティン', '/contact'], ['faker', '/faker'], ['記事', '/article'], ['SHOU', '/shou'], ['我が投稿', '/post']];
$navListR = [['デバッグ', '/edit'], ['ユーザー登録', '/register'], [$dum, '/login']];
$currentPage = request()->path();
if (strpos('/', $currentPage) !== false) {
    $currentPage = explode('/', $currentPage)[0];
}
@endphp

@switch($gnavType)
    @case(0)
    {{-- normal --}}
    <nav class="bg-gray-200 sticky top-0 text-black text-center">
        {{-- <nav class="bg-gray-200 " style="margin-left: calc(-50vw + 50%); margin-right: calc(-50vw + 50%);"> --}}
        <div class="flex w-full">

            <ul class="pb-2 flex flex-wrap justify-around w-full max-w-screen-lg m-auto">
                @foreach ($navList as $page)
                    @if (substr($page[1], 1) === $currentPage)
                        {{-- current page --}}
                        <li class="">
                            <a class="pt-2 mx-3 block border-b border-transparent border-red-600">{{ $page[0] }}</a>
                        </li>
                    @else
                        <li class="">
                            <a class="pt-2 mx-3 block hover:text-gray-600 cursor-pointer border-b border-transparent hover:border-indigo-600"
                                href="{{ url($page[1]) }}">{{ $page[0] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>

            <ul class="flex flex-wrap text-base md:ml-auto">
                @foreach ($navListR as $page)
                    @if (substr($page[1], 1) === $currentPage)
                        {{-- current page --}}
                        <li class="">
                            <a class="pt-2 mx-3 block border-b border-transparent border-red-600">{{ $page[0] }}</a>
                        </li>
                    @else
                        <li class="">
                            <a class="pt-2 mx-3 block hover:text-gray-600 cursor-pointer border-b border-transparent hover:border-indigo-600"
                                href="{{ url($page[1]) }}">{{ $page[0] }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
    @break
    @default
    {{-- global navigation less --}}
@endswitch
