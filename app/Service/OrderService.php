<?php

namespace App\Service;

use App\Models\Cart;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{
    static function storeOrder(
        string $transactionId,
        int $buyerId,
        string $status,
        float $totalAmount,
        float $amountPaid,
        string $currency,
        string $paymentMethod
    ) {
        try {
            $order = new Order();
            $order->invoice_id = uniqid();
            $order->transaction_id = $transactionId;
            $order->buyer_id = $buyerId;
            $order->status = $status;
            $order->total_amount = $totalAmount;
            $order->paid_amount = $amountPaid;
            $order->currency = $currency;
            $order->payment_method = $paymentMethod;
            $order->save();

            // Store order items
            $cart = Cart::where('user_id', $buyerId);
            $cartItems = $cart->get();
            foreach ($cartItems as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->price = $item->course->discount > 0 ? $item->course->discount : $item->course->price;
                $orderItem->course_id = $item->course_id;
                $orderItem->quantity = 1;
                $orderItem->commission_rate = config('settings.commission_rate');
                $orderItem->save();

                // Store Enrollment
                $enrollment = new Enrollment();
                $enrollment->user_id = $buyerId;
                $enrollment->course_id = $item->course_id;
                $enrollment->instructor_id = $item->course->instructor_id;
                $enrollment->save();

                // Add commission amount to instructor
                $instructor = $item->course->instructor;
                $instructor->wallet += calculateCommission(
                    $item->course->discount > 0 ? $item->course->discount : $item->course->price,
                    config('settings.commission_rate')
                );
                $instructor->save();
            }

            // Remove cart
            $cart->delete();
        } catch (\Throwable $e) {
            throw $e;
        } finally {
        }
    }
}
