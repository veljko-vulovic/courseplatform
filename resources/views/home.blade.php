<x-layouts.app>

    <!-- Hero Section -->
    <section class="py-16 text-center text-white bg-primary">
        <div class="container max-w-xl mx-auto">
            <h1 class="mb-4 text-4xl font-semibold">Welcome to our Learning Platform</h1>
            <p class="m-6 text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut nihil tempora odit
                modi sint et cumque
                numquam exercitationem voluptatibus fugiat alias nisi eaque enim maxime, sunt in labore. Explicabo,
                accusantium!</p>
        </div>
    </section>

    <section class="container mx-auto my-8">
        <h2 class="mb-4 text-2xl font-semibold">Featured Courses</h2>
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4">
            @foreach ($featuredCourses as $course)
                <x-course-card :course="$course" />
            @endforeach

        </div>
    </section>

    <livewire:all-courses />

</x-layouts.app>
