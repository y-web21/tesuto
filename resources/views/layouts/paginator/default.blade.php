@if ($paginator->hasPages())

    <nav class="flex flex-col items-center my-10">
        <ul class="flex text-gray-700">
            {{-- To First Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-left w-4 h-4">
                    </svg>
                </li>
            @else
                <li class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
                    <a href="{{ $paginator->url(1) }}" rel="prev" aria-label="@lang('pagination.first')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4">
                            <polyline points="10 18 4 12 10 6"></polyline>
                            <polyline points="20 18 14 12 20 6"></polyline>
                        </svg>
                    </a>
                </li>
            @endif


            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer"
                    aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-left w-4 h-4">
                    </svg>
                </li>
            @else
                <li class="h-8 w-8 mr-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            <div class="flex h-8 font-medium rounded-full bg-gray-200">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="w-8 md:flex justify-center items-center hidden leading-5 transition duration-150 ease-in rounded-full"
                            aria-disabled="true">
                            <span>{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="w-8 md:flex justify-center items-center hidden leading-5 transition duration-150 ease-in  rounded-full bg-pink-600 text-white"
                                    aria-current="page"><span>{{ $page }}</span></li>
                            @else
                                <li
                                    class="w-8 md:flex justify-center items-center hidden cursor-pointer leading-5 transition duration-150 ease-in  rounded-full">
                                    <a href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </a>
                </li>
            @else
                <li class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right w-4 h-4">
                    </svg>
                </li>
            @endif

            {{-- To Last Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200 cursor-pointer">
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" rel="next"
                        aria-label="@lang('pagination.last')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4">
                            <polyline points="5 18 11 12 5 6"></polyline>
                            <polyline points="15 18 21 12 15 6"></polyline>
                        </svg>
                    </a>
                </li>
            @else
                <li class="h-8 w-8 ml-1 flex justify-center items-center rounded-full bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-right w-4 h-4">
                    </svg>
                </li>
            @endif
        </ul>
    </nav>
    @php
        // dd($paginator);
        // echo $paginator->currentPage().'  kumakuma';
    @endphp
@endif
