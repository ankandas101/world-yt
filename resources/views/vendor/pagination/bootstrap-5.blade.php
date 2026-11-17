@if ($paginator->hasPages())
    <style>
        /* Utility classes */


        .flex-fill {
            flex: 1 1 auto !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .justify-items-center {
            justify-items: center !important;
        }

        .align-items-sm-center {
            align-items: center !important;
        }

        .d-sm-none {
            display: none !important;
        }

        .d-none {
            display: none !important;
        }

        .d-sm-flex {
            display: flex !important;
        }

        .flex-sm-fill {
            flex: 1 1 auto !important;
        }

        /* Text utilities */
        .small {
            font-size: 0.875rem !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }

        /* Pagination wrapper */
        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.375rem;
            margin: 0;
        }

        /* Page item spacing */
        .page-item {
            margin: 0 2px;
        }

        /* Page link base */
        .page-link {
            position: relative;
            display: block;
            padding: 0.375rem 0.75rem;
            color: #0d6efd;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        /* Hover effect */
        .page-link:hover {
            z-index: 2;
            color: #0a58ca;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        /* Active */
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        /* Disabled */
        .page-item.disabled .page-link,
        .page-item.disabled span {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }

        /* Responsive (mimic Bootstrap breakpoints) */
        @media (max-width: 575.98px) {
            .d-sm-none {
                display: flex !important;
            }

            .d-none {
                display: none !important;
            }
        }

        @media (min-width: 576px) {
            .d-sm-flex {
                display: flex !important;
            }

            .flex-sm-fill {
                flex: 1 1 auto !important;
            }

            .d-sm-none {
                display: none !important;
            }
        }
        .d-flex {
            display: flex !important;
        }
    </style>
    <nav class="justify-items-center justify-content-between" style="display: block !important">


        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between" style="padding-top: 30px">
            <div>
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span
                                    class="page-link">{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span
                                            class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
