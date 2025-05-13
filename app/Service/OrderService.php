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
                $orderItem->price = $item->course->price;
                $orderItem->course_id = $item->course_id;
                $orderItem->quantity = 1;
                $orderItem->save();

                // Store Enrollment
                $enrollment = new Enrollment();
                $enrollment->user_id = $buyerId;
                $enrollment->course_id = $item->course_id;
                $enrollment->instructor_id = $item->course->instructor_id;
                $enrollment->save();

                // Remove cart
                $cart->delete();
            }
        } catch (\Throwable $e) {
            throw $e;
        } finally {
        }
    }
}