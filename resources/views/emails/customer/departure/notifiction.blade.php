@component('mail::message')
#  Important Travel Reminder - Your Departure is Approaching

Hello {{ $booking->passengers[0]->firstname }} {{ $booking->passengers[0]->lastname }},

We hope this email finds you excited and well-prepared for your upcoming journey with {{ config('app.name') }}. As your departure date is less then 3 days, we wanted to send you a friendly reminder with some important information and travel tips.

Booking Reference: {{ $booking->pnr }}

@component('mail::button', ['url' => route('flight.ticket.show.passenger', ['id'=>$booking->id,'hash' => md5($booking->uri)])])
View Ticket
@endcomponent

If you have any specific inquiries or require further assistance, please don't hesitate to contact our customer support team at [Customer Support Contact Details]. We are here to help and ensure your travel experience is seamless and enjoyable.

Wishing you a safe and pleasant journey! Bon voyage!

Best regards,
{{ config('app.name') }}
@endcomponent