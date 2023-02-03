@component('mail::message')

{{$data->title}}<br>
{{$data->content}}

{{-- {{ config('app.name') }} --}}
@endcomponent
