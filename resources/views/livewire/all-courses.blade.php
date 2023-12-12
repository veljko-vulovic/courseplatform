<section class="container mx-auto my-8">
    <h2 class="mb-4 text-2xl font-semibold">All Courses</h2>
    <div class="grid grid-cols-1 gap-8 mb-5 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4">
        @foreach ($courses as $course)
            <x-course-card :course="$course" />
        @endforeach
    </div>
    {{ $courses->links() }}
    </div>

</section>
