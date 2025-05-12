<?php

namespace Database\Seeders;

use App\Models\CourseChapter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseChapters = [
            [
                'title' => 'Chapter 1: Python Fundamentals',
                'instructor_id' => 2,
                'course_id' => 6,
                'order' => 1,
                'status' => 1,
            ],
            [
                'title' => 'Chapter 2: Efficient Data Ingestion',
                'instructor_id' => 2,
                'course_id' => 6,
                'order' => 2,
                'status' => 1,
            ],
            [
                'title' => 'Chapter 3: Data Cleaning & Wrangling',
                'instructor_id' => 2,
                'course_id' => 6,
                'order' => 3,
                'status' => 1,
            ],
            [
                'title' => 'Chapter 4: Exploratory Data Analysis (EDA)',
                'instructor_id' => 2,
                'course_id' => 6,
                'order' => 4,
                'status' => 1,
            ],
            [
                'title' => 'Chapter 5: Data Visualization',
                'instructor_id' => 2,
                'course_id' => 6,
                'order' => 5,
                'status' => 1,
            ],
            [
                'title' => 'Chapter 6: Numerical Computing with NumPy',
                'instructor_id' => 2,
                'course_id' => 6,
                'order' => 6,
                'status' => 1,
            ],
            [
                'title' => 'Chapter 7: Introduction to Statistics in Python',
                'instructor_id' => 2,
                'course_id' => 6,
                'order' => 7,
                'status' => 1,
            ],
            [
                'title' => 'Chapter 8: Final Capstone Project',
                'instructor_id' => 2,
                'course_id' => 6,
                'order' => 8,
                'status' => 1,
            ],
        ];

        foreach ($courseChapters as $chapter) {
            $existingChapter = CourseChapter::firstOrNew(['course_id' => $chapter['course_id'], 'title' => $chapter['title']]);

            if ($existingChapter->exists) {
                // If the chapter already exists, update its data
                $existingChapter->update($chapter);
            } else {
                // If the chapter does not exist, create a new one
                CourseChapter::create($chapter);
            }
        }
    }
}
