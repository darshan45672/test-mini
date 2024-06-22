<?php

namespace Database\Factories;

use App\Models\College;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollegeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = College::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(255),
            'code' => $this->faker->text(255),
            'email' => $this->faker->email(),
            'website' => $this->faker->text(255),
            'address' => $this->faker->text(),
        ];
    }
}
