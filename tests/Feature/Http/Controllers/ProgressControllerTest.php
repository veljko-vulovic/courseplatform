<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Progress;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProgressController
 */
class ProgressControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $progress = Progress::factory()->count(3)->create();

        $response = $this->get(route('progress.index'));

        $response->assertOk();
        $response->assertViewIs('progress.index');
        $response->assertViewHas('progresses');
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $progress = Progress::factory()->create();

        $response = $this->get(route('progress.show', $progress));

        $response->assertOk();
        $response->assertViewIs('progress.show');
        $response->assertViewHas('progress');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('progress.create'));

        $response->assertOk();
        $response->assertViewIs('progress.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProgressController::class,
            'store',
            \App\Http\Requests\ProgressControllerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $user = User::factory()->create();
        $video = Video::factory()->create();
        $watched_duration = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('progress.store'), [
            'user_id' => $user->id,
            'video_id' => $video->id,
            'watched_duration' => $watched_duration,
        ]);

        $progress = Progress::query()
            ->where('user_id', $user->id)
            ->where('video_id', $video->id)
            ->where('watched_duration', $watched_duration)
            ->get();
        $this->assertCount(1, $progress);
        $progress = $progress->first();

        $response->assertRedirect(route('progress.index'));
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $progress = Progress::factory()->create();

        $response = $this->get(route('progress.edit', $progress));

        $response->assertOk();
        $response->assertViewIs('progress.edit');
        $response->assertViewHas('progress');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProgressController::class,
            'update',
            \App\Http\Requests\ProgressControllerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $progress = Progress::factory()->create();
        $user = User::factory()->create();
        $video = Video::factory()->create();
        $watched_duration = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('progress.update', $progress), [
            'user_id' => $user->id,
            'video_id' => $video->id,
            'watched_duration' => $watched_duration,
        ]);

        $progress->refresh();

        $response->assertRedirect(route('progress.index'));

        $this->assertEquals($user->id, $progress->user_id);
        $this->assertEquals($video->id, $progress->video_id);
        $this->assertEquals($watched_duration, $progress->watched_duration);
    }


    /**
     * @test
     */
    public function destroy_redirects(): void
    {
        $progress = Progress::factory()->create();

        $response = $this->delete(route('progress.destroy', $progress));

        $response->assertRedirect(route('progress.index'));
    }
}
