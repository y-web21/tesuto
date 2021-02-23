@php
    $header_type = config('const.common.BLADE.HEADER')
@endphp

@switch($disp_header)
    @case($header_type['SMALL'])
    {{-- SMALL HEADER --}}
    <section class="w-full h-100px bg-center" style="background-image:url({{ asset('image/2000x250.png') }})">
        <h1 class=""><span class="">SAMLL HEADER</span></h1>
    </section>
    @break
    @case($header_type['LARGE'])
    {{-- LARGE HEADER --}}
    <section class="w-full h-200px bg-center" style="background-image:url({{ asset('image/2000x250.png') }})">
        <h1 class=""><span class="">LEARGE HEADER</span></h1>
    </section>
    @break
    @default
    {{-- HEADERLESS --}}
@endswitch
