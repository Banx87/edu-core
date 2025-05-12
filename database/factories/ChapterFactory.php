<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //     'title' => $this->faker->sentence,
            //     'instructor_id' => 2,
            //     'course_id' => 6,
            //     'order' => $this->faker->numberBetween(1, 8),
            //     'status' => 1,
        ];
    }
}
