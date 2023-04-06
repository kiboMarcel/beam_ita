<style>

    .disabled:hover{
        border: 2px solid gray !important;
    }

    span{
        padding: 10px 15px;
        font-weight: 600;
        color: #888ea8;
    }
</style>

<div  class="paginating-container pagination-default">
    @if ($paginator->hasPages())
   
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled prev" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span >Prev</span>
                </li>
            @else
                <li class="prev">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Prev</a>
                   
                </li>
            @endif

           
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="next">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
                    
                </li>
            @else
                <li class="disabled next"  aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">Next</span>
                </li>
            @endif
        </ul>
@endif

</div>

