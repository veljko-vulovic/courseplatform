<x-layouts.app>

    <section class="container mx-auto my-8">

        <div class="flex w-1/2 space-x-10">
            <img src="https://placehold.co/400x300" alt="">
            <div class="flex flex-col space-y-5">

                <h3 class="text-xl font-bold ">
                    {{ $course->title }}
                </h3>
                <span class="text-md text-semibold">{{ $course->user->name }}</span>
                <p>{{ $course->description }}</p>


            </div>
        </div>


        <div class="container mx-auto mt-3">
            <h2 class="text-xl font-bold text-white">List of Episodes</h2>
            <ul class="w-1/2 text-white ">
                @foreach ($videos as $video)
                    <div class="flex p-3 my-2 bg-primary hover:bg-primary/80 rounded-xl ">
                        {{-- <img src="https://placehold.co/300x150" alt="Hero Image" class="mr-4 rounded-lg"> --}}
                        <img src="https://craftypixels.com/placeholder-image/300x150/ededed" alt="Hero Image"
                            class="mr-4 rounded-lg">
                        <div class="space-y-3">
                            <a class="hover:text-secondary-500" href="{{ route('video.show', $video) }}">
                                {{ $video->title }}
                            </a>
                            <p>{{ $video->description }}</p>
                        </div>

                    </div>
                @endforeach
            </ul>
        </div>
    </section>

</x-layouts.app>
