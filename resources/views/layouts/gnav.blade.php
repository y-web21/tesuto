@php
$dum = 'ログイン';
$navList = [['HOME', '/'], ['NEWS', '/news'], ['CATEGORY', '/category'], ['RANKING', '/ranking'], ['ABOUT', '/about'], ['コンスタンティン', '/contact'], ['faker', '/faker'], ['記事', '/article'], ['SHOU', '/shou'],['我が投稿', '/post'] ];
$navListR = [['デバッグ', '/edit'], ['ユーザー登録', '/register'], [$dum, '/login']];
$currentPage = request()->path();
if (strpos('/', $currentPage) !== false) {
    $currentPage = explode('/', $currentPage)[0];
}
@endphp

@switch($gnavType)
    @case(0)
    {{-- normal --}}
    <nav>
        <ul>
            @foreach ($navList as $page)
                @if (substr($page[1], 1) === $currentPage)
                    {{-- current page --}}
                    <li><a>{{ $page[0] }}</a></li>
                @else
                    <li><a href="{{ url($page[1]) }}">{{ $page[0] }}</a></li>
                @endif
            @endforeach
        </ul>
        <ul>
            @foreach ($navListR as $page)
                @if (substr($page[1], 1) === $currentPage)
                    {{-- current page --}}
                    <li><a>{{ $page[0] }}</a></li>
                @else
                    <li><a href="{{ url($page[1]) }}">{{ $page[0] }}</a></li>
                @endif
            @endforeach
        </ul>
    </nav>
    @break
    @default
    {{-- global navigation less --}}
@endswitch

