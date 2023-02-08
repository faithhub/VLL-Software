@component('mail::message')
# A new message from contact form

<b>Name: {{$data->name}}</b><br>
<b>Email: {{$data->email}}</b><br>
<b>Subject: {{$data->subject}}</b><br>
<b>Message: {{$data->message}}</b><br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
