<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ActivityType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTypeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_activity_types(): void
    {
        $activityTypes = ActivityType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('activity-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.activity_types.index')
            ->assertViewHas('activityTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_activity_type(): void
    {
        $response = $this->get(route('activity-types.create'));

        $response->assertOk()->assertViewIs('app.activity_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_activity_type(): void
    {
        $data = ActivityType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('activity-types.store'), $data);

        $this->assertDatabaseHas('activity_types', $data);

        $activityType = ActivityType::latest('id')->first();

        $response->assertRedirect(route('activity-types.edit', $activityType));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_activity_type(): void
    {
        $activityType = ActivityType::factory()->create();

        $response = $this->get(route('activity-types.show', $activityType));

        $response
            ->assertOk()
            ->assertViewIs('app.activity_types.show')
            ->assertViewHas('activityType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_activity_type(): void
    {
        $activityType = ActivityType::factory()->create();

        $response = $this->get(route('activity-types.edit', $activityType));

        $response
            ->assertOk()
            ->assertViewIs('app.activity_types.edit')
            ->assertViewHas('activityType');
    }

    /**
     * @test
     */
    public function it_updates_the_activity_type(): void
    {
        $activityType = ActivityType::factory()->create();

        $data = [];

        $response = $this->put(
            route('activity-types.update', $activityType),
            $data
        );

        $data['id'] = $activityType->id;

        $this->assertDatabaseHas('activity_types', $data);

        $response->assertRedirect(route('activity-types.edit', $activityType));
    }

    /**
     * @test
     */
    public function it_deletes_the_activity_type(): void
    {
        $activityType = ActivityType::factory()->create();

        $response = $this->delete(
            route('activity-types.destroy', $activityType)
        );

        $response->assertRedirect(route('activity-types.index'));

        $this->assertModelMissing($activityType);
    }
}
