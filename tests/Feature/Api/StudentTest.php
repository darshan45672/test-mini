<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Student;

use App\Models\College;
use App\Models\Department;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
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
    public function it_gets_students_list(): void
    {
        $students = Student::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.students.index'));

        $response->assertOk()->assertSee($students[0]->usn);
    }

    /**
     * @test
     */
    public function it_stores_the_student(): void
    {
        $data = Student::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.students.store'), $data);

        $this->assertDatabaseHas('students', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_student(): void
    {
        $student = Student::factory()->create();

        $user = User::factory()->create();
        $college = College::factory()->create();
        $department = Department::factory()->create();

        $data = [
            'sem' => $this->faker->randomNumber(0),
            'usn' => $this->faker->text(255),
            'user_id' => $user->id,
            'college_id' => $college->id,
            'department_id' => $department->id,
        ];

        $response = $this->putJson(
            route('api.students.update', $student),
            $data
        );

        $data['id'] = $student->id;

        $this->assertDatabaseHas('students', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_student(): void
    {
        $student = Student::factory()->create();

        $response = $this->deleteJson(route('api.students.destroy', $student));

        $this->assertModelMissing($student);

        $response->assertNoContent();
    }
}
