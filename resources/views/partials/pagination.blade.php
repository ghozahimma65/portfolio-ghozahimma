@if ($paginator->hasPages())
    <nav class="d-flex justify-content-center align-items-center gap-2 mt-5" aria-label="Project Pagination" data-aos="fade-up">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="btn-custom btn-custom-secondary disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <i class="bi bi-chevron-left" aria-hidden="true"></i> Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}#projects" class="btn-custom btn-custom-secondary" rel="prev" aria-label="@lang('pagination.previous')">
                <i class="bi bi-chevron-left" aria-hidden="true"></i> Previous
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="text-secondary px-2" aria-disabled="true">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="btn-custom btn-custom-accent active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}#projects" class="btn-custom btn-custom-secondary">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}#projects" class="btn-custom btn-custom-secondary" rel="next" aria-label="@lang('pagination.next')">
                Next <i class="bi bi-chevron-right" aria-hidden="true"></i>
            </a>
        @else
            <span class="btn-custom btn-custom-secondary disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                Next <i class="bi bi-chevron-right" aria-hidden="true"></i>
            </span>
        @endif
    </nav>
@endif
