@component('mail::message')
    # Order Cancelled

    You have cancelled your order {{ $order->id }}, You will get the refund soon.

    {{' You can get further details about your cancelled by logging into our website.'}}

    @component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
        Go to Website
    @endcomponent

    Thank you again for choosing us.

    Regards,<br>
    {{ config('app.name') }}
@endcomponent
