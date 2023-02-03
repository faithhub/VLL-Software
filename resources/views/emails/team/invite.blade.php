@component('mail::message')
 Hi, there!

You've been invited to join {{ Auth::user()->name }}'s team on Vll

<div style="display:flex;">
    @component('mail::button', ['url' => route('user.accept_invite', $link)])
        Accept
    @endcomponent
    @component('mail::button', ['url' => route('user.accept_invite', $link), 'color' => 'red'])
        Decline
    @endcomponent
</div>


Thanks, <br>
{{ config('app.name') }}
@endcomponent
