<div class="flex items-center justify-center flex-1 px-2 lg:ml-6 lg:justify-end">
    <div class="w-full max-w-lg lg:max-w-xs">
        <label for="search" class="sr-only">Search for songs</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <input wire:model.live.debounce.300ms="search" id="search"
                class="block w-full py-2 pl-10 pr-3 leading-5 placeholder-black transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md text-secondary-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm"
                placeholder="Search for songs..." type="search" autocomplete="off">
            @if (strlen($search) > 2)
                <ul
                    class="absolute z-50 w-full mt-2 text-sm text-gray-700 bg-white border border-gray-300 divide-y divide-gray-200 rounded-md">
                    @forelse ($searchResults as $result)
                        {{-- {!! dd($result) !!} --}}
                        <li>
                            <a 
                            @if (array_key_exists('id', $result)) href="{{ route('course.show',$result['id']) }}" 
                            @else
                            href="#" 
                            @endif
                                class="flex items-center px-4 py-4 transition duration-150 ease-in-out hover:bg-gray-200">
                                {{-- <img src="{{ $result['artworkUrl60'] }}" alt="album art" class="w-10"> --}}
                                <div class="ml-4 leading-tight">
                                    <div class="font-semibold">
                                        @if (array_key_exists('title', $result))
                                            {{ $result['title'] }}
                                        @else
                                            Untitled
                                        @endif
                                    </div>
                                    {{-- <div class="text-gray-600">
                                        @if (array_key_exists('user_id', $result))
                                            {{ $result['user_id'] }}
                                        @else
                                            No Artist
                                        @endif
                                    </div> --}}
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-4 py-4">No results found for "{{ $search }}"</li>
                    @endforelse


                </ul>
            @endif
        </div>
    </div>
</div>
