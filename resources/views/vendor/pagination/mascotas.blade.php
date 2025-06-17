@if ($paginator->hasPages())
    <nav class="pagination-mascota-wrapper" aria-label="Navegación de páginas">
        <ul class="pagination-mascota">
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <span>
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">
                                <span>{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span>
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
    .pagination-mascota-wrapper {
        text-align: center;
        margin-top: 2rem;
    }

    .pagination-mascota {
        display: inline-flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        list-style: none;
        padding: 0.5rem 1rem;
        background-color: rgba(255, 255, 255, 0);
        border-radius: 20px;
    }

    .pagination-mascota li {
        font-family: 'Segoe UI', sans-serif;
    }

    .pagination-mascota li a,
    .pagination-mascota li span {
        display: inline-block;
        padding: 0.6rem 1.2rem;
        border-radius: 30px;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        color: #1E4183;
        background-color: #ffffff;
        border: 2px solid #1E4183;
        transition: all 0.3s ease-in-out;
        position: relative;
    }

    .pagination-mascota li a:hover {
        background-color: #1E4183;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(30, 65, 131, 0.2);
    }

    .pagination-mascota li a:hover i.fas.fa-chevron-left,
    .pagination-mascota li a:hover i.fas.fa-chevron-right {
        color: #fff;
    }

    .pagination-mascota li.disabled i.fas.fa-paw {
        color: #bbb;
    }

    .pagination-mascota li.active span {
        background-color: #1E4183;
        color: #fff;
        font-weight: bold;
        border-color: #1E4183;
        box-shadow: 0 0 10px rgba(30, 65, 131, 0.3);
    }

    .pagination-mascota li.disabled span {
        background-color: #eee;
        color: #bbb;
        border-color: #ccc;
        cursor: not-allowed;
    }

    .pagination-mascota li i.fas.fa-paw,
    .pagination-mascota li i.fas.fa-chevron-left,
    .pagination-mascota li i.fas.fa-chevron-right {
        margin: 0 4px;
        color: #1E4183;
    }

    @media (max-width: 600px) {
        .pagination-mascota {
            gap: 0.3rem;
            padding: 0.5rem;
        }

        .pagination-mascota li a,
        .pagination-mascota li span {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        .pagination-mascota-wrapper {
            margin-top: 1rem;
        }

        .pagination-mascota li .text {
            display: none;
        }

        .pagination-mascota li .icon {
            display: inline-block;
        }
    }
</style>
