<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','page name is not defined')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <noscript>ウェブサイトを正しく表示するにはJavaScriptが必要です。<br>ブラウザの設定をオンにしてからページをリロードしてください。</noscript>
</head>

@php
if (!isset($headerType)) {
    $headerType = 0;
}
if (!isset($gnavType)) {
    $gnavType = 0;
}
if (!isset($footerType)) {
    $footerType = 0;
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
            @include('layouts.header', [ $headerType ])
        @show

        @section('global-nav')
            @include('layouts.gnav', [ $gnavType ])
        @show

        <div class="md:container md:mx-auto container">
            {{-- {{ request()->path() }} --}}

            <main>
                <div class="container">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    @section('footer')
        @include('layouts.footer', [ $footerType ])
    @show
</body>

</html>
