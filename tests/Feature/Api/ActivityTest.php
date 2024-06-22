<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Activity;

use App\Models\Student;
use App\Models\ActivityType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
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
    public function it_gets_activities_list(): void
    {
        $activities = Activity::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.activities.index'));

        $response->assertOk()->assertSee($activities[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_activity(): void
    {
        $data = Activity::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.activities.store'), $data);

        $this->assertDatabaseHas('activities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_activity(): void
    {
        $activity = Activity::factory()->create();

        $student = Student::factory()->create();
        $activityType = ActivityType::factory()->create();

        $data = [
            'student_id' => $student->id,
            'activity_type_id' => $activityType->id,
        ];

        $response = $this->putJson(
            route('api.activities.update', $activity),
            $data
        );

        $data['id'] = $activity->id;

        $this->assertDatabaseHas('activities', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_activity(): void
    {
        $activity = Activity::factory()->create();

        $response = $this->deleteJson(
            route('api.activities.destroy', $activity)
        );

        $this->assertModelMissing($activity);

        $response->assertNoContent();
    }
}
