<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VideoController
 */
class VideoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $videos = Video::factory()->count(3)->create();

        $response = $this->get(route('video.index'));

        $response->assertOk();
        $response->assertViewIs('video.index');
        $response->assertViewHas('videos');
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $video = Video::factory()->create();

        $response = $this->get(route('video.show', $video));

        $response->assertOk();
        $response->assertViewIs('video.show');
        $response->assertViewHas('video');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('video.create'));

        $response->assertOk();
        $response->assertViewIs('video.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VideoController::class,
            'store',
            \App\Http\Requests\VideoControllerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;
        $url = $this->faker->url;
        $course = Course::factory()->create();

        $response = $this->post(route('video.store'), [
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'course_id' => $course->id,
        ]);

        $videos = Video::query()
            ->where('title', $title)
            ->where('description', $description)
            ->where('url', $url)
            ->where('course_id', $course->id)
            ->get();
        $this->assertCount(1, $videos);
        $video = $videos->first();

        $response->assertRedirect(route('video.index'));
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $video = Video::factory()->create();

        $response = $this->get(route('video.edit', $video));

        $response->assertOk();
        $response->assertViewIs('video.edit');
        $response->assertViewHas('video');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VideoController::class,
            'update',
            \App\Http\Requests\VideoControllerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $video = Video::factory()->create();
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;
        $url = $this->faker->url;
        $course = Course::factory()->create();

        $response = $this->put(route('video.update', $video), [
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'course_id' => $course->id,
        ]);

        $video->refresh();

        $response->assertRedirect(route('video.index'));

        $this->assertEquals($title, $video->title);
        $this->assertEquals($description, $video->description);
        $this->assertEquals($url, $video->url);
        $this->assertEquals($course->id, $video->course_id);
    }


    /**
     * @test
     */
    public function destroy_redirects(): void
    {
        $video = Video::factory()->create();

        $response = $this->delete(route('video.destroy', $video));

        $response->assertRedirect(route('video.index'));
    }
}
