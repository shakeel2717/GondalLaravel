@component('mail::message')
# Payment Due - Flight Ticket Booking

Dear {{ $booking->passengers[0]->firstname }} {{ $booking->passengers[0]->lastname }},

We hope this email finds you well. We would like to inform you that the payment for your flight ticket booking is due soon. If you have any questions or require assistance regarding the payment process or your flight booking, please don't hesitate to reach out to our customer support team

Booking Reference: {{ $booking->pnr }}

@component('mail::button', ['url' => route('flight.ticket.show.passenger', ['id'=>$booking->id,'hash' => md5($booking->uri)])])
View Ticket
@endcomponent

Thank you for choosing our services, and we look forward to serving you on your upcoming journey.

Best regards,
{{ config('app.name') }}
@endcomponent