<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'title' => "Manager"
            ],
            [
                'title' => "HR Staff"
            ],
            [
                'title' => "Logistic Staff"
            ],
            [
                'title' => "Finance Staff"
            ],
            [
                'title' => "Training and Development Specialist"
            ],
        ];

        foreach ($positions as $position) {
            DB::table('job_positions')->updateOrInsert(['title' => $position['title']], $position);
        }
    }
}
