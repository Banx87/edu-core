<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(OrderSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(ChapterSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(SettingSeeder::class);
    }
}