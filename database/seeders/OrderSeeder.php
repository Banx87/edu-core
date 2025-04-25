<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'user_id' => '1',
                'product_name' => 'Samsung Galaxy S23',
                'total_price' => 999.99,
            ],
            [
                'user_id' => '2',
                'product_name' => 'MacBook Pro 16"',
                'total_price' => 2499.99,
            ],
        ];

        Order::insert($orders);
    }
}