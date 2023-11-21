<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CourseController
 */
class CourseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $courses = Course::factory()->count(3)->create();

        $response = $this->get(route('course.index'));

        $response->assertOk();
        $response->assertViewIs('course.index');
        $response->assertViewHas('courses');
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $course = Course::factory()->create();

        $response = $this->get(route('course.show', $course));

        $response->assertOk();
        $response->assertViewIs('course.show');
        $response->assertViewHas('course');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('course.create'));

        $response->assertOk();
        $response->assertViewIs('course.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CourseController::class,
            'store',
            \App\Http\Requests\CourseControllerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;

        $response = $this->post(route('course.store'), [
            'title' => $title,
            'description' => $description,
        ]);

        $courses = Course::query()
            ->where('title', $title)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $courses);
        $course = $courses->first();

        $response->assertRedirect(route('course.index'));
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $course = Course::factory()->create();

        $response = $this->get(route('course.edit', $course));

        $response->assertOk();
        $response->assertViewIs('course.edit');
        $response->assertViewHas('course');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CourseController::class,
            'update',
            \App\Http\Requests\CourseControllerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $course = Course::factory()->create();
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;

        $response = $this->put(route('course.update', $course), [
            'title' => $title,
            'description' => $description,
        ]);

        $course->refresh();

        $response->assertRedirect(route('course.index'));

        $this->assertEquals($title, $course->title);
        $this->assertEquals($description, $course->description);
    }


    /**
     * @test
     */
    public function destroy_redirects(): void
    {
        $course = Course::factory()->create();

        $response = $this->delete(route('course.destroy', $course));

        $response->assertRedirect(route('course.index'));
    }
}
