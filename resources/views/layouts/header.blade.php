@switch($headerType)
    @case(0)
    {{-- SMALL HEADER --}}
    <section class="w-full h-100px bg-center" style="background-image:url({{ asset('image/2000x250.png') }})">
        <h1 class=""><span class="">SAMLL HEADER</span></h1>
    </section>
    @break
    @case(1)
    {{-- LARGE HEADER --}}
    <section class="w-full h-200px bg-center" style="background-image:url({{ asset('image/2000x250.png') }})">
        <h1 class=""><span class="">LEARGE HEADER</span></h1>
    </section>
    @break
    @default
    {{-- HEADERLESS --}}
@endswitch
