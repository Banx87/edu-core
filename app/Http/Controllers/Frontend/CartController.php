<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class CartController extends Controller
{

    function index()
    {
        $cart = Cart::with('course')->where('user_id', Auth::id())->paginate();
        return view('frontend.pages.cart', compact('cart'));
    }
    function addToCart(int $id): Response
    {
        if (!Auth::guard('web')->check()) {
            return response(['message' => 'Please login first'], 401);
        }
        if (Auth::user()->enrollments()->where(['course_id' => $id])->exists()) {
            return response(['type' => 'info', 'message' => 'You have already enrolled in this course'], 401);
        }
        if (Cart::where(['course_id' => $id, 'user_id' => Auth::guard('web')->user()->id])->exists()) {
            return response(['message' => 'Course already added to cart'], 401);
        }

        $course = Course::findOrFail($id);
        $cart = new Cart();
        $cart->course_id = $course->id;
        $cart->user_id = Auth::guard('web')->user()->id;
        $cart->save();

        $cartItemsCount = cartTotalItems();

        return response((['message' => 'Course added to cart successfully', 'cart_items_count' => $cartItemsCount]), 200); // return response((['message' => 'Course added to cart successfully']), 200);
    }
    function removeFromCart(int $id): RedirectResponse
    {
        Cart::where(['id' => $id, 'user_id' => Auth::guard('web')->user()->id])->delete();

        notyf()->success('Removed from cart successfully');
        // return response((['message' => 'Removed from cart successfully']), 200);
        return redirect()->back();
    }
}
