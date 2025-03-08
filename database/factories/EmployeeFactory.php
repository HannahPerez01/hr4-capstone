<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\JobPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 1;
        return [
            'employee_code' => 'H' . str_pad($counter++, 3, '0', STR_PAD_LEFT),
            'employee_name' => fake()->name(),
            'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
            'job_position_id' => JobPosition::query()->inRandomOrder()->value('id'),
            'department' => fake()->randomElement(['HR', 'Logistics', 'Finance']),
            'employment_type' => fake()->randomElement(['Full Time', 'Part Time']),
            'date_hired' => fake()->dateTimeBetween('2022-11-30', '2025-02-30'),
            'status' => fake()->randomElement(['Active', 'On-leave', 'Terminated']),
        ];
    }
}
