
@if ($paginator->hasPages())

    <div class="inline-flex items-center justify-center gap-3 my-4 text-sm dark:text-gray-300">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="text-gray-500 dark:text-gray-400">Prev Page</span>
        @else
            <a
                href="{{ $paginator->previousPageUrl() }}"
                class="inline-flex items-center justify-center text-gray-900 bg-white border border-gray-100 rounded-sm size-8 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
            >
                <span class="sr-only">Prev Page</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="black">
                    <path
                        fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"
                    />
                </svg>
            </a>
        @endif

        {{-- Current Page / Total Pages Info --}}
        <p class="text-xs text-gray-900 dark:text-gray-300">
            {{ $paginator->currentPage() }} <span class="mx-0.25">/</span> {{ $paginator->lastPage() }}
        </p>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a
                href="{{ $paginator->nextPageUrl() }}"
                class="inline-flex items-center justify-center text-gray-900 bg-white border border-gray-100 rounded-sm size-8 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300"
            >
                <span class="sr-only">Next Page</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"
                    />
                </svg>
            </a>
        @else
            <span class="text-gray-500 dark:text-gray-400">Next Page</span>
        @endif

    </div>
@endif