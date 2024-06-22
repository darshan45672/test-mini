<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\College;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollegeTest extends TestCase
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
    public function it_gets_colleges_list(): void
    {
        $colleges = College::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.colleges.index'));

        $response->assertOk()->assertSee($colleges[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_college(): void
    {
        $data = College::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.colleges.store'), $data);

        $this->assertDatabaseHas('colleges', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_college(): void
    {
        $college = College::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
            'code' => $this->faker->text(255),
            'email' => $this->faker->email(),
            'website' => $this->faker->text(255),
            'address' => $this->faker->text(),
        ];

        $response = $this->putJson(
            route('api.colleges.update', $college),
            $data
        );

        $data['id'] = $college->id;

        $this->assertDatabaseHas('colleges', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_college(): void
    {
        $college = College::factory()->create();

        $response = $this->deleteJson(route('api.colleges.destroy', $college));

        $this->assertModelMissing($college);

        $response->assertNoContent();
    }
}
