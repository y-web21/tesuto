@switch($headerType)
    @case(0)
    <section class="w-full h-100px bg-center" style="background-image:url({{ asset('image/2000x250.png') }})">
        <h1 class=""><span class="">SAMLL HEADER</span></h1>
    </section>
    @break
    @case(1)

    <section class="w-full h-200px bg-center" style="background-image:url({{ asset('image/2000x250.png') }})">
        <h1 class=""><span class="">LEARGE HEADER</span></h1>
    </section>

    {{-- LARGE HEADER --}}
    @break
    @default
    HEADERLESS
@endswitch
