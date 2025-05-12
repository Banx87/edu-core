<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    function index()
    {
        return view('frontend.pages.cart');
    }
    function addToCart(int $id): Response
    {
        if (!Auth::guard('web')->check()) {
            return response((['message' => 'Please login first']), 401);
        }
        if (Cart::where(['course_id' => $id, 'user_id' => Auth::guard('web')->user()->id])->exists()) {
            return response((['message' => 'Course already added to cart']), 401);
        }

        $course = Course::findOrFail($id);
        $cart = new Cart();
        $cart->course_id = $course->id;
        $cart->user_id = Auth::guard('web')->user()->id;
        $cart->save();

        return response((['message' => 'Course added to cart successfully']), 200);
    }
}
