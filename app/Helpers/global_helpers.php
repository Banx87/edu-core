<?php

// Convert minutes to hours and minutes

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (!function_exists('minutesToTime')) {

    /**
     * Converts minutes to hours and minutes.
     *
     * @param int $minutes
     * @return string
     *
     * @example minutesToTime(90) "1h 30min"
     */
    function minutesToTime(int $minutes): string
    {
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;

        if ($hours < 1) {
            return sprintf('%d min', $minutes);
        }

        return sprintf('%d h %d min', $hours, $minutes);
    }
}

// Calculate cart total items
function cartTotalItems()
{
    return Cart::where('user_id', Auth::user()?->id)->count();
}


// calculate cart total
if (!function_exists('CartTotal')) {
    function cartTotal()
    {
        $total = 0;
        $cartItems = Cart::where('user_id', Auth::user()?->id)->get();

        foreach ($cartItems as $cartItem) {
            $coursePrice = $cartItem->course->discount > 0 ? $cartItem->course->discount : $cartItem->course->price;
            $total += $coursePrice;
        }

        return $total;
    }
}
