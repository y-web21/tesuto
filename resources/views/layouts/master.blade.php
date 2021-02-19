<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','page name is not defined')</title>
    <script>
        {{ asset('js/app.js') }} defer

    </script>
    <link rel="{{ asset('css/app.css') }}" href="stylesheet">
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
@endphp

<body>

    @section('header')
        @include('layouts.header', [ $headerType ])
    @show

    @section('global-nav')
        @include('layouts.gnav', [ $gnavType ])
    @show

    {{ request()->path() }}

    <div class="container">
        @yield('content')
    </div>

    @section('footer')
        @include('layouts.footer', [ $footerType ])
    @show

</body>

</html>
