@extends('layouts.master')
@php
$disp_gnav = config('const.common.BLADE.GNAV.DISABLE');
@endphp

@section('content')
    @include('poster.parts.layouts')
    @include('poster.parts.form_article', [$mode = 'edit'])
    @include('poster.parts.layouts_close')
@endsection
