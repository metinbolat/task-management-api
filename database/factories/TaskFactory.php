<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['Tamamlandı', 'Devam ediyor']);
        $assigned_date = $this->faker->dateTimeBetween('-1 month', 'now');
        $due_date = Carbon::instance($assigned_date)->addDays(rand(2, 7));
        $completed_date = Carbon::instance($due_date)->addDays(rand(-1, 1));
        return [
            'title' => fake()->sentence(3),
            'body' => fake()->paragraph(),
            'status' => $status,
            'assigned_date' => $assigned_date,
            'due_date' => $due_date,
            'completed_date' => $status == 'Tamamlandı' ? $completed_date : NULL,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Task $task) {

            $userIds = User::all()->pluck('id')->toArray();

            $randomUserIds = array_rand($userIds, rand(1, 3));

            $task->users()->attach($randomUserIds);
        });
    }
}
