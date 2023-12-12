@props(['course'])
<div class="flex flex-col max-w-md mx-auto overflow-hidden rounded shadow-lg">
    <img src="https://placehold.co/400x300" alt="Course Image" class="object-cover w-full h-auto">
    <div class="flex flex-col justify-between flex-1 gap-5 pb-4 max-h-fit">
        <div class="flex flex-col px-6 py-4 justify-betwween">
            <div class="mb-2 text-xl font-bold text-white">
                <a href="{{ route('course.show', $course) }}">
                    {{ $course->title }}
                </a>
            </div>
            <span
                class="mb-6 text-base text-white font-semiboldsa">{{ $course->user->name }}</span>
            <p class="text-base text-white">{{ $course->description }}</p>
        </div>
        <div class="px-6 pt-4 pb-2">
            <a href="{{ route('course.show', $course) }}"
                class="px-4 py-2 font-bold text-white bg-blue-700 rounded-full hover:bg-primary">Show</a>
        </div>
    </div>

</div>