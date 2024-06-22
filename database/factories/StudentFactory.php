<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sem' => $this->faker->randomNumber(0),
            'usn' => $this->faker->text(255),
            'user_id' => \App\Models\User::factory(),
            'college_id' => \App\Models\College::factory(),
            'department_id' => \App\Models\Department::factory(),
        ];
    }
}
