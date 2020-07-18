

@component('mail::message')
# Good day {{ $name }}

This is to notify you that your order with order number {{$order->order_num}} at our store Florax Pharmacy was successful.

@component('mail::button', ['url' => $url])
Click here to view your Order details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
