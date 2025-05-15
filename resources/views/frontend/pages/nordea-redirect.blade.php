{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nordea Payment</title>
</head>

<body>
    @php
        $payableAmount = cartTotal() * 100;
    @endphp
    <form action="{{ route('nordea.payment') }}" Method="POST">
        @csrf
        <script src="https://api.nordeaopenbanking.com/personal/v5/accounts"
            data-key="{{ config('gateway_settings.nordea_client_id') }}"
            data-currency="{{ config('gateway_settings.nordea_currency') }}" data-amount="{{ $payableAmount }}"
            data-buttontext="Pay with Nordea" data-name="Course" data-description="Payment for the course"
            data-theme.color="#F37254"></script>
    </form>

</body>

</html> --}}
