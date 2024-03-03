<x-mail::message>
    Hi <b>{!! $name ?? Auth::user()->name !!}</b>,<br>
    Your withdrawal request has been successfully proce. Here are the details:<br><br>
    Account Name: <b>{!! $acc_name !!}</b><br>
    Account Number: <b>{!! $acc_num !!}</b><br>
    Bank: <b>{!! $bank !!}</b><br>
    Amount: <b>{!! $currency !!}{!! number_format($amount, 2) !!}</b><br>
    Fee: <b>{!! $currency !!}{!! number_format($fee, 2) !!}</b><br>
    Payment Reference ID: <b>{!! $ref !!}</b><br>
    Date: <b>{!! date('D, M j, h:i a', strtotime($date)) !!}</b><br>
    <br>
    Thank you for using the Virtual Law Library!<br>
    <br>
    <b>
        {{ config('app.name') }}
    </b>
</x-mail::message>
