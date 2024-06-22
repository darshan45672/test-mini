<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Faculty;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserFacultiesTest extends TestCase
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
    public function it_gets_user_faculties(): void
    {
        $user = User::factory()->create();
        $faculties = Faculty::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.faculties.index', $user));

        $response->assertOk()->assertSee($faculties[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_user_faculties(): void
    {
        $user = User::factory()->create();
        $data = Faculty::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.faculties.store', $user),
            $data
        );

        $this->assertDatabaseHas('faculties', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $faculty = Faculty::latest('id')->first();

        $this->assertEquals($user->id, $faculty->user_id);
    }
}
