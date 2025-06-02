<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CourseBasicInfoCreateRequest;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseChapter;
use App\Models\CourseLanguage;
use App\Models\CourseLevels;
use App\Traits\Fileupload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    use Fileupload;

    function index(): View
    {
        $courses = Course::where('instructor_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('frontend.instructor-dashboard.course.index', compact('courses'));
    }
    function create(): View
    {
        return view('frontend.instructor-dashboard.course.create');
    }

    // DATA STORE FUNCTIONS
    function StoreBasicInfo(CourseBasicInfoCreateRequest $request)
    {
        $thumbnailPath = $this->uploadFile($request->file('thumbnail'));

        $course = new Course();
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->seo_description = $request->seo_description;
        $course->thumbnail = $thumbnailPath;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->description = $request->description;
        $course->preview_video_storage = $request->preview_video_storage;
        $course->preview_video_source = $request->preview_video_source;
        $course->instructor_id = Auth::guard('web')->user()->id;
        $course->save();

        // save course id on session
        Session::put('course_create_id', $course->id);

        return response([
            'status' => 'success',
            'message' => 'updated succesfully.',
            'redirect' => route('instructor.courses.edit',  ['id' => $course->id, 'step' => $request->next_step])
        ]);
    }

    function edit(Request $request)
    {
        switch ($request->step) {
            case '1':
                $course = Course::findOrFail($request->id);
                return view('frontend.instructor-dashboard.course.edit', compact('course'));
            case '2':
                $categories = CourseCategory::where("status", 1)->get();
                $levels = CourseLevels::all();
                $languages = CourseLanguage::all();
                $course = Course::findorFail($request->id);
                return view('frontend.instructor-dashboard.course.more-info', compact('categories', 'levels', 'languages', 'course'));
            case '3':
                $courseId = $request->id;
                $chapters = CourseChapter::where(['course_id' => $courseId, 'instructor_id' => Auth::user()->id])->orderBy('order')->get();
                return view('frontend.instructor-dashboard.course.course-content', compact('courseId', 'chapters'));
            case '4':
                $course = Course::findorFail($request->id);
                return view('frontend.instructor-dashboard.course.finish', compact('course'));
            default:
                // return view('frontend.instructor-dashboard.course.create');
                break;
        }
    }

    function update(Request $request)
    {
        // dd($request->all());
        switch ($request->current_step) {
            case '1':
                $rules = [
                    'title' => 'required|max:255|string',
                    'seo_description' => 'nullable|max:255|string',
                    'preview_video_storage' => 'nullable|in:youtube,vimeo,external_link,upload|string',
                    'price' => 'required|numeric',
                    'discount' => 'nullable|numeric',
                    'description' => 'required',
                    'thumbnail' => 'nullable|image|max:3000',
                    'preview_video_source' => 'nullable'
                ];

                $request->validate($rules);

                $course = Course::findOrFail($request->id);

                if ($request->hasFile('thumbnail')) {
                    $thumbnailPath = $this->uploadFile($request->file('thumbnail'));
                    $this->deleteFile($course->thumbnail);
                    $course->thumbnail = $thumbnailPath;
                }

                $course->title = $request->title;
                $course->slug = Str::slug($request->title);
                $course->seo_description = $request->seo_description;
                $course->price = $request->price;
                $course->discount = $request->discount;
                $course->description = $request->description;
                $course->preview_video_storage = $request->preview_video_storage;
                $course->preview_video_source = $request->filled('file') ? $request->file : $request->url;
                $course->instructor_id = Auth::guard('web')->user()->id;
                $course->save();

                // save course id on session
                Session::put('course_create_id', $course->id);

                return response([
                    'status' => 'success',
                    'message' => 'updated succesfully.',
                    'redirect' => route('instructor.courses.edit',  ['id' => $course->id, 'step' => $request->next_step])
                ]);
                break;

            case '2':
                // Validation
                $request->validate(
                    [
                        'capacity' => 'nullable|numeric',
                        'duration' => 'required|numeric',
                        'qna' => 'nullable|boolean',
                        'certificate' => 'nullable|boolean',
                        'category' => 'required|integer',
                        'level' => 'required|integer',
                        'language' => 'required|integer',
                    ]
                );
                // Update Course Data
                $course = Course::findOrFail($request->id);
                $course->capacity = $request->capacity;
                $course->duration = $request->duration;
                $course->qna = $request->qna ? 1 : 0;
                $course->certificate = $request->certificate ? 1 : 0;
                $course->category_id = $request->category;
                $course->course_level_id = $request->level;
                $course->course_language_id = $request->language;
                $course->save();

                return response([
                    'status' => 'success',
                    'message' => 'updated succesfully.',
                    'redirect' => route('instructor.courses.edit',  ['id' => $course->id, 'step' => $request->next_step])
                ]);
                break;

            case '3':
                return response([
                    'status' => 'success',
                    'message' => 'updated succesfully.',
                    'redirect' => route('instructor.courses.edit',  ['id' => $request->id, 'step' => $request->next_step])
                ]);
                break;
            // default:
            //     return view('frontend.instructor-dashboard.course.create');
            //     break;


            case '4':
                $rules = [
                    'message' => 'nullable|max:1000|string',
                    'status' => 'required|in:active,inactive,draft',
                ];

                $request->validate($rules);

                $course = Course::findOrFail($request->id);

                $course->message_for_reviewer = $request->message;
                $course->status = $request->status;
                $course->save();

                return response([
                    'status' => 'success',
                    'message' => 'Course created Succesfully.',
                    'redirect' => route('instructor.courses.index')
                ]);
        }
    }
}
