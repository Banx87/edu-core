<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(): View
    {
        $todaysEarnings = Order::wheredate('created_at', Carbon::today())->sum('total_amount');
        $todaysSales = Order::wheredate('created_at', Carbon::today())->count();
        $thisWeekEarnings = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_amount');
        $thisWeekSales = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();
        $thisMonthEarnings = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');
        $thisMonthSales = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $thisYearEarnings = Order::whereYear('created_at', Carbon::now()->year)
            ->sum('total_amount');
        $thisYearSales = Order::whereYear('created_at', Carbon::now()->year)
            ->count();
        $totalSales = Order::count();
        $totalSalesEarnings = Order::sum('total_amount');
        $pendingCourses = Course::where('is_approved', 'pending')->count();
        $rejectedCourses = Course::where('is_approved', 'rejected')->count();
        $totalCourses = Course::where('is_approved', 'approved')->count();

        $recentCourses = Course::where('is_approved', 'approved')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $recentBlogs = Blog::orderBy('created_at', 'desc')->take(5)->get();
        $recentOrders = Order::orderBy('created_at', 'desc')->take(5)->get();

        // Chart.js data preparation
        $monthlyOrderSums = [];
        $monthlyOrderCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyOrderSums[] = Order::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total_amount');
            $monthlyOrderCounts[] = Order::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        }


        // Return the view with the calculated data
        return view('admin.dashboard', compact(
            'todaysEarnings',
            'todaysSales',
            'thisWeekEarnings',
            'thisMonthEarnings',
            'thisWeekSales',
            'thisMonthSales',
            'thisYearEarnings',
            'thisYearSales',
            'totalSales',
            'pendingCourses',
            'rejectedCourses',
            'totalCourses',
            'totalSalesEarnings',
            'monthlyOrderSums',
            'monthlyOrderCounts',
            'recentCourses',
            'recentBlogs',
            'recentOrders'
        ));
    }
}