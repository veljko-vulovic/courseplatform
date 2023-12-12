<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
            <span class="flex">
                @if ($paginator->onFirstPage())
                    <button disabled
                        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-blue-700 transition duration-150 ease-in-out bg-gray-300 border border-white rounded-md disabled:text-blue-700 ">

                        Previous</button>
                @else
                    <button
                        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-blue-700 transition duration-150 ease-in-out bg-white border border-blue-700 rounded-md active:bg-gray-100 focus:border-blue-300 focus:outline-none focus:shadow-outline-blue hover:text-black"
                        wire:click="previousPage" wire:loading.attr="disabled" rel="prev">Previous</button>
                @endif
            </span>

            <span class="flex">
                @if ($paginator->onLastPage())
                    <button disabled
                        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-blue-700 transition duration-150 ease-in-out bg-gray-300 border border-white rounded-md disabled:text-blue-700 ">
                        Next
                    </button>
                @else
                    <button
                        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-blue-700 transition duration-150 ease-in-out bg-white border border-blue-700 rounded-md active:bg-gray-100 focus:border-blue-300 focus:outline-none focus:shadow-outline-blue hover:text-black"
                        wire:click="nextPage" wire:loading.attr="disabled" rel="next">Next</button>
                @endif
            </span>
        </nav>
    @endif
</div>
