@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">
                    <img src="{{ asset('img/icon-triangle.svg') }}" alt="" class="u-inversion l-main__triangle">
                    <img src="{{ asset('img/icon-footprints.svg') }}" alt="" class="u-inversion l-main__footprints">
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <img src="{{ asset('img/icon-triangle.svg') }}" alt="" class="u-inversion l-main__triangle">
                    <img src="{{ asset('img/icon-footprints.svg') }}" alt="" class="u-inversion l-main__footprints">
                </a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <img src="{{ asset('img/icon-footprints.svg') }}" alt="" class="l-main__footprints">
                    <img src="{{ asset('img/icon-triangle.svg') }}" alt="" class="l-main__triangle">
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">
                    <img src="{{ asset('img/icon-footprints.svg') }}" alt="" class="l-main__footprints">
                    <img src="{{ asset('img/icon-triangle.svg') }}" alt="" class="l-main__triangle">
                </span>
            </li>
        @endif
    </ul>
@endif
