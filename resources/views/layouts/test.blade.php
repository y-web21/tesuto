@php
echo __DIR__;
@endphp

@php echo __DIR__; @endphp
{{ asset('') }}

{{-- 現在のURLを取得（GETパラメーター（ ? 以降の文字列）も取得します。） --}}
{{ \Request::fullUrl() }}
{{ request()->fullUrl() }}
{{-- 例: http://test.server.tld/users/search?q=test --}}

{{-- 現在のURLを取得（GETパラメーター（ ? 以降の文字列）は取得しません） --}}
{{ url()->current() }}
{{-- 例: http://test.server.tld/users/search --}}

{{-- 現在のURLを相対で取得（GETパラメーター（ ? 以降の文字列）も取得します。） --}}
{{ str_replace(url('/'),"",request()->fullUrl()) }}
{{-- 例: /search?q=test --}}

{{-- リクエストURIの取得 --}}
{{ request()->path() }}
{{-- 例: users/search --}}

{{-- リクエストのURIが指定されたパターンにマッチするか --}}
@if ( request()->is('*users*') )
        マッチします<br>
@endif
{{-- 完全なURLを取得(クエリ文字列なし) --}}
{{ request()->url() }}
{{-- 例: http://test.server.tld/users/search --}}

{{-- リクエストメソッドの取得 --}}
{{ request()->method() }}

{{-- リクエストメソッドが指定したものにマッチするか --}}
@if( request()->isMethod('get') )
     getメソッドです<br>
@endif


@php
// echo '$GLOBALS = <br> '. var_dump($GLOBALS);
// echo '$_SERVER = <br> '. var_dump($_SERVER);
// echo '$_GET = <br> '. var_dump($_GET);
// echo '$_POST = <br> '. var_dump($_POST);
// echo '$_FILES = <br> '. var_dump($_FILES);
// echo '$_COOKIE = <br> '. var_dump($_COOKIE);
// // echo '$_SESSION = <br> '. var_dump($_SESSION);
// echo '$_REQUEST = <br> '. var_dump($_REQUEST);
// echo '$_ENV = <br> '. var_dump($_ENV);
@endphp
