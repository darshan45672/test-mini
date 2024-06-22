<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTypeActivitiesTest extends TestCase
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
    public function it_gets_activity_type_activities(): void
    {
        $activityType = ActivityType::factory()->create();
        $activities = Activity::factory()
            ->count(2)
            ->create([
                'activity_type_id' => $activityType->id,
            ]);

        $response = $this->getJson(
            route('api.activity-types.activities.index', $activityType)
        );

        $response->assertOk()->assertSee($activities[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_activity_type_activities(): void
    {
        $activityType = ActivityType::factory()->create();
        $data = Activity::factory()
            ->make([
                'activity_type_id' => $activityType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.activity-types.activities.store', $activityType),
            $data
        );

        $this->assertDatabaseHas('activities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $activity = Activity::latest('id')->first();

        $this->assertEquals($activityType->id, $activity->activity_type_id);
    }
}
