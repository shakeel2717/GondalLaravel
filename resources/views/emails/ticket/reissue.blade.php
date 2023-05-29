@component('mail::message')
# Flight Ticket Reissue Successfully

Hello {{ $booking->passengers[0]->firstname }} {{ $booking->passengers[0]->lastname }},

Thank you for booking your flight ticket. Your Ticket is Successfully Reissue, Here are the details:

Booking Reference: {{ $booking->pnr }}

@component('mail::button', ['url' => route('flight.booking.show', ['booking' => $booking->id])])
View Ticket
@endcomponent

If you have any questions or need assistance, please don't hesitate to contact us.

Thanks,
{{ config('app.name') }}
@endcomponent