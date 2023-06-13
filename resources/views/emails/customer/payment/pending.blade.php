@component('mail::message')
# Payment Due - Flight Ticket Booking

Dear {{ $booking->passengers[0]->firstname }} {{ $booking->passengers[0]->lastname }},

We hope this message finds you well. We wanted to bring to your attention that there is an outstanding balance of {{ number_format($booking->agent_margin - $booking->received,2) }} € on your account with us. We kindly request that you settle the outstanding balance as soon as possible. Prompt payment is crucial for maintaining the smooth operation of our business and ensuring the continuity of our services. Please find the details of the outstanding payment 

Booking Reference: {{ $booking->pnr }}

@component('mail::button', ['url' => route('flight.ticket.show.passenger', ['id'=>$booking->id,'hash' => md5($booking->uri)])])
View Ticket
@endcomponent

For any questions or clarifications,
Please contact us at
Gondal Travel | Pèlerinages Hajj & Omra | Séjours culturels

🇫🇷  0187653786 <br>
🇬🇧 00448007074285 <br>
🇺🇸 0018143008040 <br>

@endcomponent