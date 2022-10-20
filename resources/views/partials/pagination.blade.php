@if ($paginator->hasPages())
    <ul class="styled-pagination centered">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled previous">
                <a href="">
                    <span class="fa fa-angle-left"></span>
                </a>
            </li>
        @else
            <li class="previous">
                <a href="{{ $paginator->previousPageUrl() }}"  rel="prev"><span class="fa fa-angle-left"></span></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled previous">
                    <a href="">{{ $element }}</a>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="previous ">
                            <a href="#" class="active">{{ $page }}<span class="sr-only">(current)</span></a>
                        </li>
                    @else
                        <li class="previous">
                            <a href="{{ $url}}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="previous"><a href="{{ $paginator->nextPageUrl() }}"  rel="next"> <span class="fa fa-angle-right"></span></a></li>
        @else
            <li class="disabled">
                <a href="#" class="disabled"  aria-label="Next">
                    <span class="fa fa-angle-right"></span>
                </a>
            </li>
        @endif
    </ul>


@endif
