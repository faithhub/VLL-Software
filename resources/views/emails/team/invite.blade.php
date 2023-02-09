@component('mail::message')
 {{-- Hi, there! --}}
{{-- You've been invited to join {{ Auth::user()->name }}'s team on Vll --}}

Hi, there!
{{-- Dear................, --}}
Welcome to Virtual Law Library!

We're thrilled to have you as a member of our community, and we hope that you are excited about the future of legal research.

You have been added to {{ Auth::user()->name }}'s team as a member. As a team member, you have access to all books, and research notes in {{ Auth::user()->name }}'s library.

We offer a variety of ways for you to search for what you need: please visit our bookshop for a complete list. Whether you want to explore traditional torts or read about liability rules in the 21st century, we've got something for everyone. Please don't hesitate to contact us if you have any questions or comments, we provide 24 hours, 7 days a week support service. All you need to do is simply click help once signed into your account and our representative will be there to help you.
<div style="display:flex;">
    @component('mail::button', ['url' => route('user.accept_invite', $link)])
        Accept
    @endcomponent
    @component('mail::button', ['url' => route('user.accept_invite', $link), 'color' => 'red'])
        Decline
    @endcomponent
</div>

Kindly note that any book bought by you into {{ Auth::user()->name }}'s Library whilst you still have access to this library will not be moved or removed after your term at {{ Auth::user()->name }}'s library expires.

Cheers and have a wonderful day!

Signed:

Account Manager

{{-- Thanks, <br>
{{ config('app.name') }} --}}
@endcomponent
