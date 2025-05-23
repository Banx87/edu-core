<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutUsSection;
use App\Models\CourseCategory;
use App\Models\Feature;
use App\Models\Hero;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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

        return view('frontend.pages.home.index', compact('hero', 'feature', 'featuredCategories', 'about'));
    }
}