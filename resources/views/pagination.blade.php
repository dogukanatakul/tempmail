@if ($paginator->hasPages())
    <div class="row short-btn float-right">
        @if ($paginator->onFirstPage())
            <button class="btn btn-light"><i class="fas fa-arrow-left"></i></button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-light"><i class="fas fa-arrow-left"></i></a>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">{{ $element }}</li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="javascript:" class="btn btn-dark">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}" class="btn btn-light">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-light"><i class="fas fa-arrow-right"></i></a>
        @else
            <button class="btn btn-light"><i class="fas fa-arrow-right"></i></button>
        @endif
    </div>
@endif
