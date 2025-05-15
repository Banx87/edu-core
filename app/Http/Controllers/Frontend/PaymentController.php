<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class PaymentController extends Controller
{
    function orderSuccess()
    {
        return view('frontend.pages.order-success');
    }

    function orderFailed()
    {
        return view('frontend.pages.order-cancel');
    }

    function paypalConfig(): array
    {
        return [
            'mode'    => config('gateway_settings.paypal_mode'),
            'sandbox' => [
                'client_id'         => config('gateway_settings.paypal_client_id'),
                'client_secret'     => config('gateway_settings.paypal_client_secret'),
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => config('gateway_settings.paypal_client_id'),
                'client_secret'     => config('gateway_settings.paypal_client_secret'),
                'app_id'            => config('gateway_settings.paypal_app_id'),
            ],

            'payment_action' => 'Sale',
            'currency'       => config('gateway_settings.paypal_currency'),
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   => 'true'
        ];
    }

    function payWithPayPal(Request $request)
    {
        // dd($request->all());
        $provider = new PayPalClient($this->paypalConfig());
        $provider->getAccessToken();

        $paymentAmount = cartTotal();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel')
            ],
            "purchase_units" => [
                [
                    'amount' => [
                        'currency_code' => config('paypal.currency'),
                        'value' => $paymentAmount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['status'] == 'CREATED') {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }
    }

    function payPalSuccess(Request $request)
    {
        $provider = new PayPalClient($this->paypalConfig());
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $capture = $response['purchase_units'][0]['payments']['captures'][0];

            $transactionId = $capture['id'];
            $amountPaid = $capture['amount']['value'];
            $currency = $capture['amount']['currency_code'];

            try {
                OrderService::storeOrder(
                    transactionId: $transactionId,
                    buyerId: Auth::user()->id,
                    status: 'completed',
                    totalAmount: $amountPaid,
                    amountPaid: $amountPaid,
                    currency: $currency,
                    paymentMethod: 'paypal'
                );

                notyf()->success('Order completed successfully.');
                return redirect()->route('order-success');
            } catch (\Throwable $e) {
                dd($e->getMessage());
            }
        }

        return redirect()->route('order-failed')->with('Order failed. Something went wrong');
    }

    function payPalCancel(Request $request)
    {
        return redirect()->route('order-failed')->with('Order failed. Something went wrong');
    }

    function payWithStripe(Request $request)
    {
        Stripe::setApiKey(config('gateway_settings.stripe_secret'));

        $response = StripeSession::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => config('gateway_settings.stripe_currency'),
                    'product_data' => [
                        'name' => 'Course',
                    ],
                    'unit_amount' => cartTotal() * 100,
                ],
                'quantity' => cartTotalItems(),
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect()->away($response->url);
    }

    function stripeSuccess(Request $request)
    {
        Stripe::setApiKey(config('gateway_settings.stripe_secret'));
        $response = StripeSession::retrieve($request->session_id);

        if ($response->status == 'complete' && $response->payment_status == 'paid') {

            $currency = strtoupper($response->currency);
            $amountPaid = $response->amount_total / 100;
            $transactionId = $response->payment_intent;

            try {
                OrderService::storeOrder(
                    transactionId: $transactionId,
                    buyerId: Auth::user()->id,
                    status: 'completed',
                    totalAmount: $amountPaid,
                    amountPaid: $amountPaid,
                    currency: $currency,
                    paymentMethod: 'stripe'
                );

                return redirect()->route('order-success');
            } catch (\Throwable $e) {
                dd($e->getMessage());
            }
        }

        return redirect()->route('order-failed')->with('Order failed. Something went wrong');
    }

    function stripeCancel(Request $request)
    {
        return redirect()->route('order-failed')->with('Order failed. Something went wrong');
    }
}
