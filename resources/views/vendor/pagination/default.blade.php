@if ($paginator->hasPages())
    <div class="paging">
        <div class="paging__wrap">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a href="#"  class="paging__item">
                    <i class="icon icon-chevron-left"></i>
                </a>
{{--                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
{{--                    <span aria-hidden="true">&lsaquo;</span>--}}
{{--                </li>--}}
            @else
                <a href="#{{ $paginator->previousPageUrl() }}"  class="paging__item" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="icon icon-chevron-left"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="paging__items">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <a href="#" aria-disabled="true" class="paging__item active disabled">
                            {{ $element }}
                        </a>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a href="#" aria-disabled="true" class="paging__item active">
                                    {{ $page }}
                                </a>
{{--                                <li class="active" aria-current="page"><span>{{ $page }}</span></li>--}}
                            @else
                                <a href="{{ $url }}" aria-disabled="true" class="paging__item">
                                    {{ $page }}
                                </a>
{{--                                <li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                            @endif
                        @endforeach
                        @if ($paginator->total() > 5)
                                <div  class="paging__item paging__item_disabled">
                                    ...
                                </div>
                                <a href="{{ $paginator->getUrl($paginator->lastPage()) }}" aria-disabled="true" class="paging__item">
                                    {{ $paginator->lastPage() }}
                                </a>
                        @endif
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="paging__item">
                    <i class="icon icon-chevron-right"></i>
                </a>
{{--                <li>--}}
{{--                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>--}}
{{--                </li>--}}
            @else
                <a href="#"  class="paging__item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <i class="icon icon-chevron-right"></i>
                </a>
{{--                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                    <span aria-hidden="true">&rsaquo;</span>--}}
{{--                </li>--}}
            @endif
        </div>
    </div>
@endif
