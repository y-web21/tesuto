@if ($paginator->hasPages())
    @php
        echo $paginator->currentPage().'  kumakuma';
    @endphp
    <nav>
        <ul class="pagination">
            {{-- To First Page Link --}}
            <li class="page-item {{ $paginator->onFirstPage() === true ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url(1) }}">@lang('pagination.first')</a>
            </li>

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif

            {{-- To Last Page Link --}}
            <li class="page-item {{ $paginator->hasMorePages() === true ? '' : ' disabled' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">@lang('pagination.last')</a>
            </li>
        </ul>
    </nav>
@endif
