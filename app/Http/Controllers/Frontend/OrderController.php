<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function index(): View
    {
        // Fetch the orders for the authenticated user
        $orderItems = OrderItem::whereHas('course', function ($query) {
            $query->where('instructor_id', Auth::user()->id);
        })->paginate(25);

        return view('frontend.instructor-dashboard.order.index', compact('orderItems'));
    }
}
