<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ public_path('assets/dashboard/css/pdf.css') }}" type="text/css">
</head>

<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <img src="{{ public_path('assets/web/logo/vll-b.png') }}" alt="laravel daily" width="100" />
            </td>
            <td class="w-half">
                @if ($data['payment_type'] == 'withdraw')
                    <h5>Payout ID: {{ $data['ref'] }}</h5>
                @elseif ($data['payment_type'] == 'material_trans')
                    <h5>Receipt ID: {{ $data['ref'] }}</h5>
                @endif
            </td>
        </tr>
    </table>
    <hr>

    {{-- <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>To:</h4></div>
                    <div>John Doe</div>
                    <div>123 Acme Str.</div>
                </td>
                <td class="w-half">
                    <div><h4>From:</h4></div>
                    <div>Laravel Daily</div>
                    <div>London</div>
                </td>
            </tr>
        </table>
    </div>
  --}}

    <div class="margin-top margin-bottom">

        @if ($data['payment_type'] == 'withdraw')
            <h2 style="text-align: center">Payout Details</h2>
            <p> Account Name: <b>{{ $data['acc_name'] }}</b></p>
            <p> Account Number: <b>{{ $data['acc_num'] }}</b></p>
            <p> Bank: <b>{{ $data['bank'] }}</b></p>
            <p> Amount: <b>{{ $data['currency'] }}{{ number_format($data['amount'], 2) }}</b></p>
            <p> Fee: <b>{{ $data['currency'] }}{{ number_format($data['fee'], 2) }}</b></p>
            <p> Payment Reference ID: <b>{{ $data['ref'] }}</b></p>
            <p> Date: <b>{{ date('D, M j, h:i a', strtotime($data['date'])) }}</b></p>
        @elseif ($data['payment_type'] == 'material_trans')
            <h2 style="text-align: center">Payment Receipt</h2>
            <p> Name: <b>{{ $data['name'] }}</b></p>
            <p> Material: <b>{{ $data['material'] }}</b></p>
            <p> Amount: <b>{{ $data['currency'] }}{{ number_format($data['amount'], 2) }}</b></p>
            <p> Mode: <b style="text-transform: capitalize;">{{ $data['type'] }}</b></p>
            @if ($data['type'] == 'rented')
                <p> Material Expires On: <b>{{ date('D, M j, h:i a', strtotime($data['expires_on'])) }}</b></p>
            @endif
            <p> Payment Reference ID: <b>{{ $data['ref'] }}</b></p>
            <p> Date: <b>{{ date('D, M j, h:i a', strtotime($data['date'])) }}</b></p>
        @endif
    </div>
    <hr>
    {{-- <div class="total">
        Total: $129.00 USD
    </div> --}}

    <div class="footer margin-top">
        <p style="text-align: center">Please contact our Customer Support if there is any issue with your receipt</p>
        {{-- <div>Thank you</div> --}}
        <div><b style="font-size: 20px">&copy; {{ config('app.name') }}</b></div>
    </div>
</body>

</html>
