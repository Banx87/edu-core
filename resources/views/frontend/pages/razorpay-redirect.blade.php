<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Razorpay Payment</title>
</head>

<body>
    @php
        $amount = cartTotal() * 100 * config('gateway_settings.razorpay_rate');
    @endphp
    <form action="{{ route('razorpay.payment') }}" method="POST">
        @csrf
        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ config('gateway_settings.razorpay_key') }}"
            data-currency="{{ config('gateway_settings.razorpay_currency') }}" data-amount="{{ $amount }}"
            data-buttontext="Pay with Razorpay" data-name="Course" data-description="Payment for the course"
            data-theme.color="#F37254"></script>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const button = document.querySelector('.razorpay-payment-button');
        button.style.display = 'none';
        button.click();
        }));
    </script>
</body>

</html>
