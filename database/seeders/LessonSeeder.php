<?php

namespace Database\Seeders;

use App\Models\CourseChapterLesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = [
            [
                'title' => 'Installing Your Toolkit',
                'slug' => 'installing-your-toolkit',
                'description' => 'Setting up Anaconda or Miniconda
    Creating virtual environments
    Managing packages with pip and conda',
                'instructor_id' => 2,
                'course_id' => 1,
                'chapter_id' => 1,
                'file_path' => 'https://www.youtube.com/watch?v=rIfdg_Ot-LI&ab_channel=Fireship',
                'storage' => 'youtube',
                'volume' => null,
                'duration' => 10,
                'file_type' => 'video',
                'downloadable' => 0,
                'order' => 1,
                'is_preview' => 1,
                'status' => 1,
                'lesson_type' => 'lesson',
                'created_at' => '2025-05-11 08:01:11',
                'updated_at' => '2025-05-11 08:01:11',
            ],
            [
                'title' => 'Python Basics Refresher',
                'slug' => 'python-basics-refresher',
                'description' => 'Variables, data types, and basic operations
    Control flow: if statements, loops
    Writing and calling functions',
                'instructor_id' => 2,
                'course_id' => 6,
                'chapter_id' => 1,
                'file_path' => 'https://youtube.com',
                'storage' => 'youtube',
                'volume' => null,
                'duration' => 8,
                'file_type' => 'video',
                'downloadable' => 0,
                'order' => 2,
                'is_preview' => 1,
                'status' => 1,
                'lesson_type' => 'lesson',
                'created_at' => '2025-05-11 08:02:23',
                'updated_at' => '2025-05-11 08:02:23',
            ],
            [
                'title' => 'Working with Data Structures',
                'slug' => 'working-with-data-structures',
                'description' => 'Lists, tuples, sets, dictionaries
    List/dict comprehensions
    When to use each structure',
                'instructor_id' => 2,
                'course_id' => 6,
                'chapter_id' => 1,
                'file_path' => 'https://youtube.com',
                'storage' => 'youtube',
                'volume' => null,
                'duration' => 17,
                'file_type' => 'video',
                'downloadable' => 0,
                'order' => 3,
                'is_preview' => 1,
                'status' => 1,
                'lesson_type' => 'lesson',
                'created_at' => '2025-05-11 08:03:11',
                'updated_at' => '2025-05-11 08:03:11',
            ],
            [
                'title' => 'Modules and Packages',
                'slug' => 'modules-and-packages',
                'description' => 'Standard library modules you need
    Import syntax and best practices
    Creating your own modules',
                'instructor_id' => 2,
                'course_id' => 6,
                'chapter_id' => 1,
                'file_path' => 'https://youtube.com',
                'storage' => 'youtube',
                'volume' => null,
                'duration' => 25,
                'file_type' => 'video',
                'downloadable' => 0,
                'order' => 4,
                'is_preview' => 0,
                'status' => 1,
                'lesson_type' => 'lesson',
                'created_at' => '2025-05-11 08:03:38',
                'updated_at' => '2025-05-11 08:03:38',
            ],
            [
                'title' => 'Reading CSVs with pandas',
                'slug' => 'reading-csvs-with-pandas',
                'description' => 'Using pd.read_csv() options
    Handling delimiters, encodings, large files',
                'instructor_id' => 2,
                'course_id' => 1,
                'chapter_id' => 2,
                'file_path' => 'https://youtube.com',
                'storage' => 'youtube',
                'volume' => null,
                'duration' => 14,
                'file_type' => 'video',
                'downloadable' => 0,
                'order' => 1,
                'is_preview' => 0,
                'status' => 1,
                'lesson_type' => 'lesson',
                'created_at' => '2025-05-11 08:11:07',
                'updated_at' => '2025-05-11 08:11:07',
            ],
            [
                'title' => 'Excel, JSON & SQL Sources',
                'slug' => 'excel-json-sql-sources',
                'description' => 'pd.read_excel(), pd.read_json()
    Connecting to a SQLite/MySQL database',
                'instructor_id' => 2,
                'course_id' => 6,
                'chapter_id' => 2,
                'file_path' => 'https://youtube.com',
                'storage' => 'youtube',
                'volume' => null,
                'duration' => 5,
                'file_type' => 'video',
                'downloadable' => 0,
                'order' => 2,
                'is_preview' => 0,
                'status' => 1,
                'lesson_type' => 'lesson',
                'created_at' => '2025-05-11 08:11:32',
                'updated_at' => '2025-05-11 08:11:32',
            ],
            [
                'title' => 'Web Scraping for Data',
                'slug' => 'web-scraping-for-data',
                'description' => 'Using requests & BeautifulSoup
    Parsing HTML tables',
                'instructor_id' => 2,
                'course_id' => 6,
                'chapter_id' => 2,
                'file_path' => 'https://youtube.com',
                'storage' => 'youtube',
                'volume' => null,
                'duration' => 20,
                'file_type' => 'video',
                'downloadable' => 0,
                'order' => 3,
                'is_preview' => 0,
                'status' => 1,
                'lesson_type' => 'lesson',
                'created_at' => '2025-05-11 08:11:56',
                'updated_at' => '2025-05-11 08:11:56',
            ],
            [
                'title' => 'APIs and JSON into DataFrames',
                'slug' => 'apis-and-json-into-dataframes',
                'description' => 'Consuming RESTful APIs
    Normalizing nested JSON into tabular form',
                'instructor_id' => 2,
                'course_id' => 6,
                'chapter_id' => 2,
                'file_path' => 'https://youtube.com',
                'storage' => 'youtube',
                'volume' => null,
                'duration' => 12,
                'file_type' => 'video',
                'downloadable' => 0,
                'order' => 4,
                'is_preview' => 0,
                'status' => 1,
                'lesson_type' => 'lesson',
                'created_at' => '2025-05-11 08:12:25',
                'updated_at' => '2025-05-11 08:12:25',
            ],
            [
                'title' => 'Matplotlib Fundamentals',
                'slug' => 'matplotlib-fundamentals',
                'description' => 'Creating line, bar, and scatter plots. Customizing axes, titles, and legends.',
                'instructor_id' => 2,
                'course_id' => 1,
                'chapter_id' => 3,
                'file_path' => 'https://youtube.com',
                'storage' => 'youtube',
                'volume' => null,
                'duration' => 20,
                'file_type' => 'video',
                'downloadable' => 0,
                'order' => 1,
                'is_preview' => 0,
                'status' => 1,
                'lesson_type' => 'lesson',
                'created_at' => '2025-05-11 08:13:00',
                'updated_at' => '2025-05-11 08:13:00',
            ],
            [
                'title' => 'Visualizing DataFrames Directly',
                'slug' => 'visualizing-dataframes-directly',
                'description' => 'Pandas’ built-in .plot() interface. Quick plots vs. full customization.',
                'instructor_id' => 2,
                'course_id' => 1,
                'chapter_id' => 4,
                'file_path' => 'https://youtube.com',
                'storage' => 'youtube',
                'volume' => null,
                'duration' => 18,
                'file_type' => 'video',
                'downloadable' => 0,
                'order' => 2,
                'is_preview' => 0,
                'status' => 1,
                'lesson_type' => 'lesson',
                'created_at' => '2025-05-11 08:13:30',
                'updated_at' => '2025-05-11 08:13:30',
            ],
            // Add more lessons here, ensuring chapter_id exists in course_chapters table
        ];

        foreach ($lessons as $lesson) {
            $existingLesson = CourseChapterLesson::firstOrNew(['chapter_id' => $lesson['chapter_id'], 'title' => $lesson['title']]);

            if ($existingLesson->exists) {
                // If the lesson already exists, update its data
                $existingLesson->update($lesson);
            } else {
                // If the lesson does not exist, create a new one
                CourseChapterLesson::create($lesson);
            }
        }
    }
}
