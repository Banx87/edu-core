<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsSection;
use App\Models\BecomeInstructorSection;
use App\Models\Brand;
use App\Models\Counter;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CustomPage;
use App\Models\Feature;
use App\Models\FeaturedInstructor;
use App\Models\Hero;
use App\Models\LatestCourseSection;
use App\Models\Newsletter;
use App\Models\Testimonial;
use App\Models\VideoSection;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FrontendController extends Controller
{
    function index(): View
    {
        $hero = Hero::first();
        $feature = Feature::first();
        $featuredCategories = CourseCategory::withCount(['subCategories as active_course_count' => function ($query) {
            $query->whereHas('courses', function ($query) {
                $query->where(['status' => 'active', 'is_approved' => 'approved']);
            });
        }])->where(['parent_id' => null, 'set_trending' => 1])->limit(12)->get();

        $about = AboutUsSection::first();
        $latestCourses = LatestCourseSection::first();
        $becomeInstructor = BecomeInstructorSection::first();
        $video = VideoSection::first();
        $brands = Brand::where('status', 1)->get();
        $featuredInstructors = FeaturedInstructor::first();
        $featuredInstructorCourses = Course::whereIn('id', json_decode($featuredInstructors?->featured_courses ?? '[]'))->get();
        $testimonials = Testimonial::all();

        return view('frontend.pages.home.index', compact(
            'hero',
            'feature',
            'featuredCategories',
            'about',
            'latestCourses',
            'becomeInstructor',
            'video',
            'brands',
            'featuredInstructors',
            'featuredInstructorCourses',
            'testimonials'
        ));
    }

    function about(): View
    {
        $about = AboutUsSection::first();
        $counters = Counter::first();
        $testimonials = Testimonial::all();

        return view('frontend.pages.about', compact('about', 'counters', 'testimonials'));
    }

    function newsletterSubscribe(Request $request): Response
    {
        request()->validate([
            'newsletter_email' => 'required|email|unique:newsletters,email',
        ], [
            'newsletter_email.required' => 'The email field is required.',
            'newsletter_email.email' => 'Please enter a valid email address.',
            'newsletter_email.unique' => 'This email is already subscribed to our newsletter.'
        ]);

        $newsletter = new Newsletter();
        $newsletter->email = $request->newsletter_email;
        $newsletter->save();

        return response([
            'status' => 'success',
            'message' => ('You have successfully subscribed to our newsletter.')
        ]);
    }

    function customPage(string $slug): View
    {
        $custom_page = CustomPage::where('slug', $slug)->where('status', 1)->firstOrFail();
        return view('frontend.pages.custom-page', compact('custom_page'));
    }
}