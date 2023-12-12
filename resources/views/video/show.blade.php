<x-layouts.app>

    <div class=" grid grid-cols-[auto_1fr]">
        <div class="p-6 bg-gray-900">
            <a href="{{route("course.show",$video->course)}}">
            
            <h3 class="mb-2 text-xl font-bold">
                {{ $video->course->title }}
            </h3>
        </a>
            <ul>
                @foreach ($courseEpisodes as $index => $courseEpisode)
                    <li class="px-2 py-6 border-b border-white text-semibold">
                        <a href="{{route('video.show',$courseEpisode)}}" class="hover:text-secondary-500">
                            <span class="px-4 py-2 mr-4 font-bold border rounded-full ">{{ $index + 1 }}</span>
                            {{ $courseEpisode->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <section class="container mx-auto">

            <div class="flex justify-center">
                <livewire:video-player videoUrl="{{ route('getVideo', $video->url) }}" videoId="{{ $video->id }}" />
            </div>
            <div class="w-1/2 mx-auto">
                <div class="flex flex-col">

                    <div class="flex items-end justify-between">
                        <h3 class="mt-6 text-xl">
                            {{ $video->title }}
                        </h3>
                        <span> {{ $video->course->user->name }}</span>
                    </div>

                    <div>
                        <h3 class="my-4 text-lg font-medium">About Episode</h3>
                        <p>{{ $video->description }}</p>
                    </div>



                </div>
            </div>
            <div class="h-96">

            </div>

        </section>

    </div>
    <script></script>
</x-layouts.app>
