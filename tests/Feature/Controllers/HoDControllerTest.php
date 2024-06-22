<?php

namespace Tests\Feature\Controllers;

use App\Models\HoD;
use App\Models\User;

use App\Models\Department;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HoDControllerTest extends TestCase
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
    public function it_displays_index_view_with_ho_ds(): void
    {
        $hoDs = HoD::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('ho-ds.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.ho_ds.index')
            ->assertViewHas('hoDs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_ho_d(): void
    {
        $response = $this->get(route('ho-ds.create'));

        $response->assertOk()->assertViewIs('app.ho_ds.create');
    }

    /**
     * @test
     */
    public function it_stores_the_ho_d(): void
    {
        $data = HoD::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('ho-ds.store'), $data);

        $this->assertDatabaseHas('hods', $data);

        $hoD = HoD::latest('id')->first();

        $response->assertRedirect(route('ho-ds.edit', $hoD));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_ho_d(): void
    {
        $hoD = HoD::factory()->create();

        $response = $this->get(route('ho-ds.show', $hoD));

        $response
            ->assertOk()
            ->assertViewIs('app.ho_ds.show')
            ->assertViewHas('hoD');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_ho_d(): void
    {
        $hoD = HoD::factory()->create();

        $response = $this->get(route('ho-ds.edit', $hoD));

        $response
            ->assertOk()
            ->assertViewIs('app.ho_ds.edit')
            ->assertViewHas('hoD');
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

        $response = $this->put(route('ho-ds.update', $hoD), $data);

        $data['id'] = $hoD->id;

        $this->assertDatabaseHas('hods', $data);

        $response->assertRedirect(route('ho-ds.edit', $hoD));
    }

    /**
     * @test
     */
    public function it_deletes_the_ho_d(): void
    {
        $hoD = HoD::factory()->create();

        $response = $this->delete(route('ho-ds.destroy', $hoD));

        $response->assertRedirect(route('ho-ds.index'));

        $this->assertModelMissing($hoD);
    }
}
