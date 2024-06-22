<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\College;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CollegeControllerTest extends TestCase
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
    public function it_displays_index_view_with_colleges(): void
    {
        $colleges = College::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('colleges.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.colleges.index')
            ->assertViewHas('colleges');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_college(): void
    {
        $response = $this->get(route('colleges.create'));

        $response->assertOk()->assertViewIs('app.colleges.create');
    }

    /**
     * @test
     */
    public function it_stores_the_college(): void
    {
        $data = College::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('colleges.store'), $data);

        $this->assertDatabaseHas('colleges', $data);

        $college = College::latest('id')->first();

        $response->assertRedirect(route('colleges.edit', $college));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_college(): void
    {
        $college = College::factory()->create();

        $response = $this->get(route('colleges.show', $college));

        $response
            ->assertOk()
            ->assertViewIs('app.colleges.show')
            ->assertViewHas('college');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_college(): void
    {
        $college = College::factory()->create();

        $response = $this->get(route('colleges.edit', $college));

        $response
            ->assertOk()
            ->assertViewIs('app.colleges.edit')
            ->assertViewHas('college');
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

        $response = $this->put(route('colleges.update', $college), $data);

        $data['id'] = $college->id;

        $this->assertDatabaseHas('colleges', $data);

        $response->assertRedirect(route('colleges.edit', $college));
    }

    /**
     * @test
     */
    public function it_deletes_the_college(): void
    {
        $college = College::factory()->create();

        $response = $this->delete(route('colleges.destroy', $college));

        $response->assertRedirect(route('colleges.index'));

        $this->assertModelMissing($college);
    }
}
