<?php

namespace Database\Seeders;

use App\Models\PaymentSetting;
use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_title',
                'value' => 'Edu-Core',
                'created_at' => '2025-05-16 13:49:25',
                'updated_at' => '2025-05-16 14:26:51',
            ],
            [
                'key' => 'phone',
                'value' => '+1 (921) 537-1183',
                'created_at' => '2025-05-16 13:49:25',
                'updated_at' => '2025-05-16 13:51:50',
            ],
            [
                'key' => 'location',
                'value' => 'Pennsylvania, US',
                'created_at' => '2025-05-16 13:49:25',
                'updated_at' => '2025-05-16 14:26:51',
            ],
            [
                'key' => 'currency',
                'value' => 'USD',
                'created_at' => '2025-05-16 13:50:36',
                'updated_at' => '2025-05-16 14:26:51',
            ],
            [
                'key' => 'currency_icon',
                'value' => '$',
                'created_at' => '2025-05-16 13:50:36',
                'updated_at' => '2025-05-16 14:26:51',
            ],
            [
                'key' => 'commission_rate',
                'value' => '70',
                'created_at' => '2025-05-17 07:16:15',
                'updated_at' => '2025-05-17 07:47:54',
            ],
            [
                'key' => 'sender_email',
                'value' => 'admin@gmail.com',
                'created_at' => '2025-05-31 08:31:51',
                'updated_at' => '2025-05-31 08:31:51',
            ],
            [
                'key' => 'receiver_email',
                'value' => 'admin.support@gmail.com',
                'created_at' => '2025-05-31 08:31:51',
                'updated_at' => '2025-05-31 08:31:51',
            ],
            [
                'key' => 'site_logo',
                'value' => '/uploads/educore_1749464456_6846b588b83fe_.png',
                'created_at' => '2025-06-09 09:47:56',
                'updated_at' => '2025-06-09 10:20:56',
            ],
            [
                'key' => 'site_footer_logo',
                'value' => '/uploads/educore_1749466039_6846bbb77da7c_.png',
                'created_at' => '2025-06-09 09:47:56',
                'updated_at' => '2025-06-09 10:47:19',
            ],
            [
                'key' => 'site_favicon',
                'value' => '/uploads/educore_1749466039_6846bbb7844e8_.png',
                'created_at' => '2025-06-09 09:53:11',
                'updated_at' => '2025-06-09 10:47:19',
            ],
            [
                'key' => 'site_breadcrumb',
                'value' => '/uploads/educore_1749466039_6846bbb785ac4_.jpg',
                'created_at' => '2025-06-09 09:53:11',
                'updated_at' => '2025-06-09 10:47:19',
            ],
            [
                'key' => 'mail_mailer',
                'value' => 'smtp',
                'created_at' => '2025-06-10 08:18:55',
                'updated_at' => '2025-06-10 08:18:55',
            ],
            [
                'key' => 'mail_host',
                'value' => 'sandbox.smtp.mailtrap.io',
                'created_at' => '2025-06-10 08:18:55',
                'updated_at' => '2025-06-10 08:18:55',
            ],
            [
                'key' => 'mail_port',
                'value' => '2525',
                'created_at' => '2025-06-10 08:18:55',
                'updated_at' => '2025-06-10 08:18:55',
            ],
            [
                'key' => 'mail_username',
                'value' => '6a873ebb2492be',
                'created_at' => '2025-06-10 08:18:55',
                'updated_at' => '2025-06-10 08:18:55',
            ],
            [
                'key' => 'mail_password',
                'value' => 'cdda1d09c5b206',
                'created_at' => '2025-06-10 08:18:55',
                'updated_at' => '2025-06-10 08:18:55',
            ],
            [
                'key' => 'mail_encryption',
                'value' => 'tls',
                'created_at' => '2025-06-10 08:18:55',
                'updated_at' => '2025-06-10 08:18:55',
            ],
            [
                'key' => 'mail_queue',
                'value' => 'on',
                'created_at' => '2025-06-10 08:18:55',
                'updated_at' => '2025-06-10 08:20:11',
            ],
        ];
        $payment_settings = [
            [
                'key' => 'paypal_mode',
                'value' => 'sandbox',
                'created_at' => '2025-05-13 15:08:23',
                'updated_at' => '2025-05-14 08:18:12',
            ],
            [
                'key' => 'paypal_currency',
                'value' => 'USD',
                'created_at' => '2025-05-13 15:08:23',
                'updated_at' => '2025-05-14 08:41:52',
            ],
            [
                'key' => 'paypal_rate',
                'value' => '1.98',
                'created_at' => '2025-05-13 15:08:23',
                'updated_at' => '2025-05-14 08:16:38',
            ],
            [
                'key' => 'paypal_client_id',
                'value' => 'AcESFdRsxnGi2bKzeOC64J1xnGsOH0ooeGeOoJU3K9mIaf59JzuauN3UBj6foHOgLx74r8m9LcsDnGlh',
                'created_at' => '2025-05-13 15:08:23',
                'updated_at' => '2025-05-14 08:18:04',
            ],
            [
                'key' => 'paypal_client_secret',
                'value' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
                'created_at' => '2025-05-13 15:08:23',
                'updated_at' => '2025-05-14 08:18:05',
            ],
            [
                'key' => 'paypal_app_id',
                'value' => 'App_id',
                'created_at' => '2025-05-13 15:08:23',
                'updated_at' => '2025-05-14 08:18:05',
            ],
            [
                'key' => 'stripe_status',
                'value' => 'inactive',
                'created_at' => '2025-05-14 09:50:46',
                'updated_at' => '2025-05-14 12:51:34',
            ],
            [
                'key' => 'stripe_currency',
                'value' => 'USD',
                'created_at' => '2025-05-14 09:50:46',
                'updated_at' => '2025-05-14 13:10:33',
            ],
            [
                'key' => 'stripe_rate',
                'value' => '1',
                'created_at' => '2025-05-14 09:50:46',
                'updated_at' => '2025-05-15 09:20:30',
            ],
            [
                'key' => 'stripe_publishable_key',
                'value' => 'pk_test_51ROdu8PnNwEk6GXo4UweaSUDYxlY3qsASnJ72nSjS57YwGEzChvzLZSdZhi24TH6mD6P3wpOtLDoRlM0SvpebrG900AgqELUYd',
                'created_at' => '2025-05-14 09:50:46',
                'updated_at' => '2025-05-14 12:51:25',
            ],
            [
                'key' => 'stripe_secret',
                'value' => env('STRIPE_SECRET'),
                'created_at' => '2025-05-14 09:50:46',
                'updated_at' => '2025-05-14 12:51:25',
            ],
            [
                'key' => 'razorpay_status',
                'value' => 'active',
                'created_at' => '2025-05-15 09:18:09',
                'updated_at' => '2025-05-15 09:18:09',
            ],
            [
                'key' => 'razorpay_currency',
                'value' => 'INR',
                'created_at' => '2025-05-15 09:18:09',
                'updated_at' => '2025-05-15 10:24:09',
            ],
            [
                'key' => 'razorpay_rate',
                'value' => '84',
                'created_at' => '2025-05-15 09:18:09',
                'updated_at' => '2025-05-15 09:18:09',
            ],
            [
                'key' => 'razorpay_key',
                'value' => 'rzp_test_cvrsy43xvBZfDT',
                'created_at' => '2025-05-15 09:18:09',
                'updated_at' => '2025-05-15 10:03:12',
            ],
            [
                'key' => 'razorpay_secret',
                'value' => env('RAZORPAY_SECRET'),
                'created_at' => '2025-05-15 09:18:09',
                'updated_at' => '2025-05-15 12:14:59',
            ],
            [
                'key' => 'nordea_status',
                'value' => 'inactive',
                'created_at' => '2025-05-15 10:01:41',
                'updated_at' => '2025-05-15 10:06:45',
            ],
            [
                'key' => 'nordea_currency',
                'value' => 'AED',
                'created_at' => '2025-05-15 10:01:41',
                'updated_at' => '2025-05-15 10:01:41',
            ],
            [
                'key' => 'nordea_rate',
                'value' => '1',
                'created_at' => '2025-05-15 10:01:41',
                'updated_at' => '2025-05-15 10:01:41',
            ],
            [
                'key' => 'nordea_client_id',
                'value' => '06edbdd1a1b4de14dacf3d3144adc591',
                'created_at' => '2025-05-15 10:10:05',
                'updated_at' => '2025-05-15 10:10:05',
            ],
            [
                'key' => 'nordea_client_secret',
                'value' => env('NORDEA_CLIENT_SECRET'),
                'created_at' => '2025-05-15 10:10:05',
                'updated_at' => '2025-05-15 10:10:05',
            ],
        ];



        foreach ($payment_settings as $setting) {
            PaymentSetting::create($setting);
        }
        foreach ($settings as $setting) {
            Settings::create($setting);
        }
    }
}