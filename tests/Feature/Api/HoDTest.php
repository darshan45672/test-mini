<?php

namespace Tests\Feature\Api;

use App\Models\HoD;
use App\Models\User;

use App\Models\Department;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HoDTest extends TestCase
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
    public function it_gets_ho_ds_list(): void
    {
        $hoDs = HoD::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.ho-ds.index'));

        $response->assertOk()->assertSee($hoDs[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_ho_d(): void
    {
        $data = HoD::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.ho-ds.store'), $data);

        $this->assertDatabaseHas('hods', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_ho_d(): void
    {
        $hoD = HoD::factory()->create();

        $department = Department::factory()->create();

        $data = [
            'department_id' => $department->id,
        ];

        $response = $this->putJson(route('api.ho-ds.update', $hoD), $data);

        $data['id'] = $hoD->id;

        $this->assertDatabaseHas('hods', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_ho_d(): void
    {
        $hoD = HoD::factory()->create();

        $response = $this->deleteJson(route('api.ho-ds.destroy', $hoD));

        $this->assertModelMissing($hoD);

        $response->assertNoContent();
    }
}
