<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ActivityType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTypeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_activity_types_list(): void
    {
        $activityTypes = ActivityType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.activity-types.index'));

        $response->assertOk()->assertSee($activityTypes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_activity_type(): void
    {
        $data = ActivityType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.activity-types.store'), $data);

        $this->assertDatabaseHas('activity_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_activity_type(): void
    {
        $activityType = ActivityType::factory()->create();

        $data = [];

        $response = $this->putJson(
            route('api.activity-types.update', $activityType),
            $data
        );

        $data['id'] = $activityType->id;

        $this->assertDatabaseHas('activity_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_activity_type(): void
    {
        $activityType = ActivityType::factory()->create();

        $response = $this->deleteJson(
            route('api.activity-types.destroy', $activityType)
        );

        $this->assertModelMissing($activityType);

        $response->assertNoContent();
    }
}
