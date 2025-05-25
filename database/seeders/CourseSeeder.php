<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructor = User::where('email', 'instructor@gmail.com')->firstOrFail(); // Replace with the instructor's email or ID

        if ($instructor) {
            // Create courses for the instructor
            $courses = [
                [
                    'id' => 1,
                    'instructor_id' => 2,
                    'title' => 'Python for Data Analysis: From Zero to Hero',
                    'slug' => 'python-for-data-analysis-from-zero-to-hero',
                    'seo_description' => 'Python for Data Analysis: From Zero to Hero',
                    'duration' => '350',
                    'price' => '59',
                    'discount' => '30',
                    'thumbnail' => '/uploads/educore_1746955287_68206c1709b32_.jpg',
                    'preview_video_storage' => 'youtube',
                    'preview_video_source' => 'https://www.youtube.com/watch?v=4Y6t7Dv4qa0',
                    'description' => 'Master Python programming with a focus on real-world data analysis. Learn to manipulate datasets, perform statistical analysis, and create insightful visualizations using libraries like pandas, NumPy, and Matplotlib.',
                    'capacity' => (string)random_int(30, 100),
                    'certificate' => 1,
                    'qna' => 1,
                    'message_for_reviewer' => 'Please review my course. I have put a lot of effort into it and would appreciate your valuable feedback.',
                    'is_approved' => 'approved',
                    'status' => 'active',
                    'category_id' => 18,
                    'course_level_id' => 1,
                    'course_language_id' => 18,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 2,
                    'instructor_id' => 2,
                    'title' => 'UX Design Essentials: Crafting User-Centered Experiences',
                    'slug' => 'ux-design-essentials-crafting-user-centered-experiences',
                    'seo_description' => 'UX Design Essentials: Crafting User-Centered Experiences',
                    'duration' => '6',
                    'price' => '149',
                    'discount' => '100',
                    'thumbnail' => '/uploads/educore_1746955321_68206c18d49a2_.jpg',
                    'preview_video_storage' => 'youtube',
                    'preview_video_source' => 'https://www.youtube.com/watch?v=VhJXWv4Qc1c',
                    'description' => 'Dive into the fundamentals of user experience (UX) design: user research, wireframing, prototyping, and usability testing. Build your portfolio with real-world design challenges.',
                    'capacity' => (string)random_int(30, 100),
                    'certificate' => 1,
                    'qna' => 1,
                    'message_for_reviewer' => 'I am excited to share my UX Design Essentials course with you. I believe it will be a valuable resource for designers looking to improve their skills.',
                    'is_approved' => 'approved',
                    'status' => 'active',
                    'category_id' => 18,
                    'course_level_id' => 1,
                    'course_language_id' => 18,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 3,
                    'instructor_id' => 2,
                    'title' => 'Digital Marketing Masterclass: SEO, SEM & Social Media',
                    'slug' => 'digital-marketing-masterclass-seo-sem-social-media',
                    'seo_description' => 'Digital Marketing Masterclass: SEO, SEM & Social Media',
                    'duration' => '10',
                    'price' => '249',
                    'discount' => '20',
                    'thumbnail' => '/uploads/educore_1746955351_68206c1a2fbaa_.jpg',
                    'preview_video_storage' => 'youtube',
                    'preview_video_source' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'description' => 'Learn the core strategies in digital marketing: search engine optimization (SEO), search engine marketing (SEM), content marketing, and social media advertising. Optimize campaigns and measure ROI.',
                    'capacity' => (string)random_int(30, 100),
                    'certificate' => 1,
                    'qna' => 1,
                    'message_for_reviewer' => 'I have put a lot of effort into creating a comprehensive digital marketing course. I would appreciate your feedback on how I can improve it.',
                    'is_approved' => 'approved',
                    'status' => 'active',
                    'category_id' => 18,
                    'course_level_id' => 1,
                    'course_language_id' => 18,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 4,
                    'instructor_id' => 2,
                    'title' => 'Full-Stack Web Development with JavaScript',
                    'slug' => 'full-stack-web-development-with-javascript',
                    'seo_description' => 'Full-Stack Web Development with JavaScript',
                    'duration' => '12',
                    'price' => '349',
                    'discount' => '0',
                    'thumbnail' => '/uploads/educore_1746955376_68206c1c9f2e8_.jpg',
                    'preview_video_storage' => 'youtube',
                    'preview_video_source' => 'https://www.youtube.com/watch?v=VhJXWv4Qc1c',
                    'description' => 'Become a full-stack developer by learning front-end (React) and back-end (Node.js, Express, MongoDB). Build and deploy production-ready web applications.',
                    'capacity' => (string)random_int(30, 100),
                    'certificate' => 1,
                    'qna' => 1,
                    'message_for_reviewer' => 'I am excited to share my full-stack web development course with you. I believe it will be a valuable resource for developers looking to improve their skills.',
                    'is_approved' => 'approved',
                    'status' => 'active',
                    'category_id' => 18,
                    'course_level_id' => 1,
                    'course_language_id' => 18,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 5,
                    'instructor_id' => 2,
                    'title' => 'Conversational Spanish: Beginner to Intermediate',
                    'slug' => 'conversational-spanish-beginner-to-intermediate',
                    'seo_description' => 'Conversational Spanish: Beginner to Intermediate',
                    'duration' => '5',
                    'price' => '129',
                    'discount' => '0',
                    'thumbnail' => '/uploads/educore_1746955384_68206c1f1c82b_.jpg',
                    'preview_video_storage' => 'youtube',
                    'preview_video_source' => 'https://www.youtube.com/watch?v=yYc7F3yf6nU',
                    'description' => 'Build practical Spanish conversation skills for travel, work, and everyday life. Focus on speaking, listening, and cultural nuances through interactive dialogues.',
                    'capacity' => (string)random_int(30, 100),
                    'certificate' => 1,
                    'qna' => 1,
                    'message_for_reviewer' => 'Please review my course. I am excited to share it with you and would appreciate your feedback.',
                    'is_approved' => 'approved',
                    'status' => 'active',
                    'category_id' => 18,
                    'course_level_id' => 1,
                    'course_language_id' => 18,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 6,
                    'instructor_id' => 2,
                    'title' => 'Productivity & Time Management: Achieve Your Goals',
                    'slug' => 'productivity-time-management-achieve-your-goals',
                    'seo_description' => 'Productivity & Time Management: Achieve Your Goals',
                    'duration' => '4',
                    'price' => '99',
                    'discount' => '20',
                    'thumbnail' => '/uploads/educore_1746955484_68206c1f1ca2b_.jpg',
                    'preview_video_storage' => 'youtube',
                    'preview_video_source' => 'https://www.youtube.com/watch?v=7Yj8yf7YjZ0',
                    'description' => 'Learn evidence-based techniques to boost focus, manage tasks, and eliminate procrastination. Implement systems like GTD, Pomodoro, and Eisenhower Matrix.',
                    'capacity' => (string)random_int(30, 100),
                    'certificate' => 1,
                    'qna' => 1,
                    'message_for_reviewer' => 'Please review my course.',
                    'is_approved' => 'approved',
                    'status' => 'active',
                    'category_id' => 18,
                    'course_level_id' => 1,
                    'course_language_id' => 18,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            foreach ($courses as $course) {
                $existingCourse = Course::firstOrNew(['slug' => $course['slug']]);

                if ($existingCourse->exists) {
                    // If the course already exists, update its data
                    $existingCourse->update($course);
                } else {
                    // If the course does not exist, create a new one
                    Course::create($course);
                }
            }
        }
    }
}
