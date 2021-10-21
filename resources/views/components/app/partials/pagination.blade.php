@if($action->lastPage() > 1)
    <ul class="pagination mt-3">
        <li class="page-item @if($action->onFirstPage()) disabled @endif">
            <a class="page-link" href="{{ $action->previousPageUrl() }}" tabindex="-1" aria-disabled="true">
                <em class="icon ni ni-back-ios"></em>
            </a>
        </li>
        @foreach($action->getUrlRange($action->currentPage() > 1 ? $action->currentPage() - 1 : 1, $action->lastPage() <= 5 ? $action->lastPage() : 5) as $link)
            <li class="page-item @if(explode("=", $link)[1] == $action->currentPage()) active @endif">
                <a class="page-link" href="{{ $link }}">{{ explode("=", $link)[1] }}</a>
            </li>
        @endforeach
        <li class="page-item @if($action->currentPage() == $action->lastPage()) disabled @endif">
            <a class="page-link" href="{{ $action->nextPageUrl() }}">
                <em class="icon ni ni-forward-ios"></em>
            </a>
        </li>
    </ul>
@endif