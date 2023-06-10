@component('mail::message')
#  That's great to hear that you have a flight departure soon! 

Hello {{ $booking->passengers[0]->firstname }} {{ $booking->passengers[0]->lastname }},

To ensure a smooth travel experience, here are a few things you should keep in mind to be ready to fly: 

1.Check-in: Make sure you have completed the check-in process either online or at the airport, depending on the airline's requirements. This includes obtaining your boarding pass.
2.Luggage: Verify the baggage allowance for your flight and pack accordingly. Check if you need to carry any essential items in your carry-on luggage and ensure they meet the airline's restrictions. 
3.Pack your essentials: Make sure you have all the necessary travel documents, such as your passport, boarding pass, and any required visas. Pack your bags with the items you'll need during your trip, including clothes, toiletries, medications, and any other personal belongings.
4.Arrive at the airport early: It's advisable to arrive at the airport at least two hours before domestic flights and three hours before international flights. This will give you enough time to check in


Booking Reference: {{ $booking->pnr }}

@component('mail::button', ['url' => route('flight.ticket.show.passenger', ['id'=>$booking->id,'hash' => md5($booking->uri)])])
View Ticket
@endcomponent

Best wishes for your travel!  May your journey be smooth, your flights be on time, and your experiences be filled with joy and adventure. May you arrive safely at your destination and create wonderful memories along the way. 

Bon voyage and have a fantastic trip!

Wishing you a safe and pleasant journey! Bon voyage!


For any questions or clarifications,
Please contact us at
Gondal Travel | Pèlerinages Hajj & Omra | Séjours culturels

🇫🇷  0187653786   
🇬🇧 00448007074285
🇺🇸 0018143008040

Best regards,
{{ config('app.name') }}
@endcomponent