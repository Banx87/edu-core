<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class InstructorDashboardController extends Controller
{
    function index()
    {
        $pendingCourses = Course::where('instructor_id', user()->id)
            ->where('is_approved', 'pending')
            ->orderBy('id', 'DESC')
            ->limit(5)->count();
        $approvedCourses = Course::where('instructor_id', user()->id)
            ->where('is_approved', 'approved')
            ->orderBy('id', 'DESC')
            ->limit(5)->count();
        $rejectedCourses = Course::where('instructor_id', user()->id)
            ->where('is_approved', 'rejected')
            ->orderBy('id', 'DESC')
            ->limit(5)->count();
        $totalCourses = Course::where('instructor_id', user()->id)->count();
        $totalStudents = Enrollment::where('instructor_id', user()->id)
            ->where('have_access', 1)
            ->count();
        // $totalEarnings = Course::where('instructor_id', user()->id)->sum('earnings');
        $totalPendingCourses = Course::where('instructor_id', user()->id)
            ->where('is_approved', 'pending')->count();
        $totalApprovedCourses = Course::where('instructor_id', user()->id)
            ->where('is_approved', 'approved')->count();
        $totalRejectedCourses = Course::where('instructor_id', user()->id)
            ->where('is_approved', 'rejected')->count();


        // Calculate monthly sales earnings based on commission rate
        $monthlySales = OrderItem::whereHas('course', function ($query) {
            $query->where('instructor_id', user()->id);
        })
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        $monthlySalesEarnings = 0;
        foreach ($monthlySales as $sale) {
            $monthlySalesEarnings += calculateCommission($sale->price, $sale->commission);
        }
        // ***********************************************************************

        $totalEarnings = OrderItem::whereHas('course', function ($query) {
            $query->where('instructor_id', user()->id);
        })->get()->sum(function ($item) {
            return calculateCommission($item->price, $item->commission);
        });

        $orderItems = OrderItem::whereHas('course', function ($q) {
            $q->where('instructor_id', user()->id);
        })->paginate(25);

        return view('frontend.instructor-dashboard.index', compact(
            'pendingCourses',
            'approvedCourses',
            'rejectedCourses',
            'totalCourses',
            'totalStudents',
            'totalEarnings',
            'totalPendingCourses',
            'totalApprovedCourses',
            'totalRejectedCourses',
            'orderItems',
            'monthlySalesEarnings'
        ));
    }
}
