<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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

    function payWithPayPal(Request $request)
    {
        // dd($request->all());
        $provider = new PayPalClient();
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
        $provider = new PayPalClient();
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
        dd($request->all());
    }
}