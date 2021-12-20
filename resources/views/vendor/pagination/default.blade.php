@if ($paginator->hasPages())
    <nav>
        {{-- <ul class="pagination">
            <li class="paginate_button page-item previous disabled" id="zero-config_previous"><a href="#"
                    aria-controls="zero-config" data-dt-idx="0" tabindex="0" class="page-link"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-arrow-left">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg></a></li>
            <li class="paginate_button page-item active"><a href="#" aria-controls="zero-config" data-dt-idx="1"
                    tabindex="0" class="page-link">1</a></li>
            <li class="paginate_button page-item next disabled" id="zero-config_next"><a href="#"
                    aria-controls="zero-config" data-dt-idx="2" tabindex="0" class="page-link"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-arrow-right">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg></a></li>
        </ul> --}}
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li> --}}
                <li class="paginate_button page-item previous disabled" id="zero-config_previous"><a href="#"
                    aria-controls="zero-config" data-dt-idx="0" tabindex="0" class="page-link"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-arrow-left">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg></a></li>
            @else
            <li class="paginate_button page-item previous " id="zero-config_previous"><a href="{{ $paginator->previousPageUrl() }}"
                aria-controls="zero-config" data-dt-idx="0" tabindex="0" class="page-link"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-arrow-left">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg></a></li>
                {{-- <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li> --}}
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
                        <li class="paginate_button page-item active"><a href="#" aria-controls="zero-config" data-dt-idx="1"
                            tabindex="0" class="page-link">{{ $page }}</a></li>
                        @else
                        <li class="paginate_button page-item "><a href="{{ $url }}" aria-controls="zero-config" data-dt-idx="1"
                            tabindex="0" class="page-link">{{ $page }}</a></li>

                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                {{-- <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li> --}}
                <li class="paginate_button page-item next " id="zero-config_next"><a href="{{ $paginator->nextPageUrl() }}"
                    aria-controls="zero-config" data-dt-idx="2" tabindex="0" class="page-link"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-arrow-right">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg></a></li>
            @else
            <li class="paginate_button page-item next disabled" id="zero-config_next"><a href="#"
                aria-controls="zero-config" data-dt-idx="2" tabindex="0" class="page-link"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-arrow-right">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg></a></li>
            @endif
        </ul>
    </nav>
@endif
