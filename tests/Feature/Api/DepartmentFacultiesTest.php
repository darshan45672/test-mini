<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Faculty;
use App\Models\Department;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentFacultiesTest extends TestCase
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
    public function it_gets_department_faculties(): void
    {
        $department = Department::factory()->create();
        $faculties = Faculty::factory()
            ->count(2)
            ->create([
                'department_id' => $department->id,
            ]);

        $response = $this->getJson(
            route('api.departments.faculties.index', $department)
        );

        $response->assertOk()->assertSee($faculties[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_department_faculties(): void
    {
        $department = Department::factory()->create();
        $data = Faculty::factory()
            ->make([
                'department_id' => $department->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.departments.faculties.store', $department),
            $data
        );

        $this->assertDatabaseHas('faculties', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $faculty = Faculty::latest('id')->first();

        $this->assertEquals($department->id, $faculty->department_id);
    }
}
