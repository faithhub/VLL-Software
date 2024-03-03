
    @component('mail::message')
        Hi <b>{{ $name ?? Auth::user()->name }}</b>,<br>
        Thank you for your material purchase at Virtual Law Library. Here are the details:
        <br><br>
        Material: <b>{{ $material }}</b><br>
        Amount: <b>{{ $currency }}{{ number_format($amount, 2) }}</b><br>
        Mode: <b style="text-transform: capitalize;">{{ $type }}</b><br>
        @if ($type == 'rented')
            Material Expires On: <b>{{ date('D, M j, h:i a', strtotime($expires_on)) }}</b><br>
        @endif
        Payment Reference ID: <b>{{ $ref }}</b><br>
        Date: <b>{{ date('D, M j, h:i a', strtotime($date)) }}</b><br>
        <br>
        Thank you for using the Virtual Law Library!
        <br>
        <b>
            {{ config('app.name') }}
        </b>
    @endcomponent