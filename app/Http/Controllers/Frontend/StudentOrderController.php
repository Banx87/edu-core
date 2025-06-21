<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StudentOrderController extends Controller
{
    function index(): View
    {
        $orders = Order::where('buyer_id', user()->id)
            ->paginate(25);

        return view('frontend.student-dashboard.order.index', compact('orders'));
    }

    function show(Order $order): View
    {
        if ($order->buyer_id !== user()->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('frontend.student-dashboard.order.show', compact('order'));
    }
}
