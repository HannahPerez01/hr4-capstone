<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => "admin12",
                'email' => "admin12@gmail.com",
                'password' => Hash::make('password'),
                'code_id' => '123',
                'image' => 'asd.png'
            ]
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(['email' => $user['email']], $user);
        }
    }
}
