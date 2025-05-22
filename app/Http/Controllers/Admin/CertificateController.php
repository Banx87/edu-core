<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertificateBuilder;
use App\Models\CertificateBuilderItem;
use App\Models\Course;
use App\Models\WatchHistory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    function download(Course $course)
    {
        $watchedLessonCount = WatchHistory::where([
            'user_id' => Auth::user()->id,
            'course_id' => $course->id,
            'is_completed' => 1,
        ])->count();
        $lessonCount = $course->lessons->count();

        if ($watchedLessonCount != $lessonCount) {
            return redirect()->back()->with('error', 'You have not completed all lessons of this course.');
        }

        $certificate = CertificateBuilder::first();
        $certificateItems = CertificateBuilderItem::all();
        $html = view(
            'frontend.student-dashboard.my-courses.certificate',
            compact('certificate', 'certificateItems')
        )->render();

        $html = str_replace("[student_name]", Auth::user()->name, $html);
        $html = str_replace("[course_name]", $course->title, $html);
        $html = str_replace("[date]", date('d.m.Y'), $html);
        $html = str_replace("[platform_name]", 'Edu Core', $html);
        $html = str_replace("[instructor_name]", $course->instructor->name, $html);

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');
        return $pdf->stream('certificate.pdf');
        // return $pdf->download('certificate.pdf');

        // $pdf = Pdf::loadView(
        //     'frontend.student-dashboard.my-courses.certificate',
        //     compact('certificate', 'certificateItems')
        // )->setPaper('a4', 'landscape')->stream();
        // return $pdf;
        // return $pdf->download('certificate.pdf');
        // return view('frontend.student-dashboard.my-courses.certificate', compact('certificate', 'certificateItems'));
    }
}