<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','page name is not defined')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <noscript>ウェブサイトを正しく表示するにはJavaScriptが必要です。<br>ブラウザの設定をオンにしてからページをリロードしてください。</noscript>
</head>

@php
if (!isset($disp_header)) {
    $disp_header = config('const.common.BLADE.HEADER.SMALL');
}
if (!isset($disp_gnav)) {
    $disp_gnav = config('const.common.BLADE.GNAV.ENABLE');
}
if (!isset($disp_lnav)) {
    $disp_gnav = config('const.common.BLADE.LNAV.DISABLE');
}
if (!isset($disp_footer)) {
    $disp_footer = config('const.common.BLADE.FOOTER.ENABLE');
}

// ssl 未実装
// if (empty($_SERVER['HTTPS']))
// {
//     header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");
//     exit;
// }

@endphp

<body>
    <div class="footer-fixed">
        @section('header')
            @include('layouts.header', [ $disp_header ])
        @show

        @section('global-nav')
            @include('layouts.gnav', [ $disp_gnav ])
        @show

        {{-- {{ 'session dump = '}}
        @if (Session::has('editing_title'))
        {{ Session::get('editing_title') }}
        {{ Session::get('editing_content') }}
        @endif --}}

        <div class="md:container md:mx-auto container">
            {{-- {{ request()->path() }} --}}

            {{-- @section('left-nav')
                @include('layouts.side_nav_left', [ $disp_lnav ])
            @show --}}

            <main>
                <div class="container">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    @section('footer')
        @include('layouts.footer', [ $disp_footer ])
    @show
</body>

</html>
