<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\College;
use App\Models\Student;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollegeStudentsTest extends TestCase
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
    public function it_gets_college_students(): void
    {
        $college = College::factory()->create();
        $students = Student::factory()
            ->count(2)
            ->create([
                'college_id' => $college->id,
            ]);

        $response = $this->getJson(
            route('api.colleges.students.index', $college)
        );

        $response->assertOk()->assertSee($students[0]->usn);
    }

    /**
     * @test
     */
    public function it_stores_the_college_students(): void
    {
        $college = College::factory()->create();
        $data = Student::factory()
            ->make([
                'college_id' => $college->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.colleges.students.store', $college),
            $data
        );

        $this->assertDatabaseHas('students', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $student = Student::latest('id')->first();

        $this->assertEquals($college->id, $student->college_id);
    }
}
