<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john_doe@gmail.com',
                'password' => bcrypt('salasana'),
                'role' => 'student',
            ],
            [
                'name' => 'Opettaja',
                'email' => 'instructor@gmail.com',
                'password' => bcrypt('salasana'),
                'role' => 'instructor',
            ],
            [
                'name' => 'Michael Scott',
                'email' => 'michael.scott@testing.com',
                'password' => bcrypt('salasana'),
                'role' => 'student',
            ],
        ];

        User::insert($users);
    }
}