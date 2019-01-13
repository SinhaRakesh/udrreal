@component('mail::message')
#New Enquiry for "{{ $property->title }}" at UdaipurRealtors.com

Property URL: {{ route('properties.show', $property->id) }}

### Contact Details
<small>
    <b>Email:</b> {{ $request['email'] }}<br>
    <b>Mobile:</b> {{ $request['mobile'] }}<br>
    <b>Message:</b> {{ $request['message'] }}<br>
</small>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
