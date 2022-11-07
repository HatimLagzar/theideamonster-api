<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            Task::CONTENT_COLUMN     => $this->faker->text,
            Task::USER_ID_COLUMN     => User::factory(),
            Task::CATEGORY_ID_COLUMN => Category::factory(),
        ];
    }
}
