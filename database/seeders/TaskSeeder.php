<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(4)
            ->create();

        $users->each(function (User $user) {
            $categories = Category::factory()->count(4)
                ->create();

            $categories->each(function (Category $category) use ($user) {
                Task::factory()->count(5)->create([
                    Task::USER_ID_COLUMN     => $user->getId(),
                    Task::CATEGORY_ID_COLUMN => $category->getId(),
                ]);
            });
        });
    }
}
