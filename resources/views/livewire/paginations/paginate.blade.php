<div>
    @if ($paginator->hasPages())
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#">
                            <i class="fas fa-angle-double-left fa-xs fa-fw"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="#" wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                            <i class="fas fa-angle-double-left fa-xs fa-fw"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled">
                            <a class="page-link" href="#">
                                <span aria-hidden="true">{{ $element }}</span>
                            </a>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link" href="#">
                                    <span aria-hidden="true">{{ $page }}</span>
                                </a>
                            </li>
                            @else
                            <li class="page-item">
                                <a class="page-link" href="#" wire:click="gotoPage({{ $page }})">
                                    <span aria-hidden="true">{{ $page }}</span>
                                </a>
                            </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach


                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="#" wire:click="nextPage" wire:loading.attr="disabled">
                            <i class="fas fa-angle-double-right fa-xs fa-fw"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link" href="#">
                            <i class="fas fa-angle-double-right fa-xs fa-fw"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
