@component('mail::message')
# Flight Ticket Booked

Hello {{ $passenger->firstname }} {{ $passenger->lastname }},

Thank you for booking your flight ticket. Here are the details:

Booking Reference: {{ $booking->pnr }}

@component('mail::button', ['url' => route('flight.ticket.show.passenger', ['id'=>$booking->id,'hash' => md5($booking->uri)])])
View Ticket
@endcomponent

If you have any questions or need assistance, please don't hesitate to contact us.

Thanks,
{{ config('app.name') }}
@endcomponent