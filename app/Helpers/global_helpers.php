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

if (!function_exists('user')) {
    function user()
    {
        return auth('web')->user();
    }
}

if (!function_exists('adminUser')) {
    function adminUser()
    {
        return auth('admin')->user();
    }
}

// Calculate cart total items
function cartTotalItems()
{
    return Cart::where('user_id', Auth::user()?->id)->count();
}


// calculate cart total
if (!function_exists('cartTotal')) {
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

if (!function_exists('cartTotalNoDiscount')) {
    function cartTotalNoDiscount()
    {
        $total = 0;
        $cartItems = Cart::where('user_id', Auth::user()?->id)->get();

        foreach ($cartItems as $cartItem) {
            $total += $cartItem->course->price;
        }

        return $total;
    }
}

if (!function_exists('totalDiscount')) {
    function totalDiscount()
    {
        $discount = 0;
        $cartItems = Cart::where('user_id', Auth::user()?->id)->get();

        foreach ($cartItems as $cartItem) {
            if ($cartItem->course->discount > 0) {
                $discount += $cartItem->course->discount;
            }
        }

        return $discount;
    }
}

function getCurrencySymbols(): array
{
    $currencies = config('gateway_currencies.paypal_currencies');

    $currencySymbols = [];
    foreach ($currencies as $currency) {
        $currencySymbols[$currency['code']] = $currency['symbol'];
    }

    return $currencySymbols;
}

// calculate commission
if (!function_exists('calculateCommission')) {
    function calculateCommission($amount, $commissionRate)
    {
        if ($commissionRate < 0 || $commissionRate > 100) {
            throw new InvalidArgumentException('Commission rate must be a percentage between 0 and 100.');
        }
        if ($amount <= 0) {
            throw new InvalidArgumentException('Amount must be greater than zero.');
        }
        return ($amount * $commissionRate) / 100;
    }
}
