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
                <a href="{{ $paginator->previousPageUrl() }}"  class="paging__item" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="icon icon-chevron-left"></i>
                </a>
            @endif

            @if($paginator->currentPage() > 3)
                <a href="{{ $paginator->url(1) }}"  aria-disabled="true" class="paging__item">
                    1
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="paging__items">
                @foreach ($elements as $element)
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a href="#" aria-disabled="true" class="paging__item active">
                                    {{ $page }}
                                </a>
{{--                                <li class="active" aria-current="page"><span>{{ $page }}</span></li>--}}
                            @else
                                @if($paginator->onFirstPage())
                                    @if($page < 6)
                                        <a href="{{ $url }}" aria-disabled="true" class="paging__item">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @elseif(!$paginator->hasMorePages())
                                    @if(($paginator->lastPage() - $page) < 6)
                                        <a href="{{ $url }}" aria-disabled="true" class="paging__item">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @else
                                    @if((($paginator->currentPage() - $page) < 3 && ($paginator->currentPage() - $page) > 0) ||
                                        (($page - $paginator->currentPage()) < 3 && ($page - $paginator->currentPage()) > 0))
                                        <a href="{{ $url }}" aria-disabled="true" class="paging__item">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endif
{{--                                <li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                            @endif
                        @endforeach

                    @endif
                @endforeach
            </div>

            @if (($paginator->lastPage() - $paginator->currentPage()) > 2)
                <a href="{{ $paginator->url($paginator->lastPage()) }}" aria-disabled="true" class="paging__item">
                    {{ $paginator->lastPage() }}
                </a>
            @endif

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
