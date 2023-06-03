@component('mail::message')
# Warm Birthday Wishes from {{ config('app.name') }}

Hello {{ $passenger->firstname }} {{ $passenger->lastname }},

We hope this email finds you in good health and high spirits. On behalf of the entire team at {{ config('app.name') }}, we would like to extend our heartfelt birthday wishes to you on this special day!

Birthdays are a time of joy, reflection, and celebration, and we wanted to take a moment to express our gratitude for your continued support and loyalty. Your presence as a valued customer has been instrumental in our growth and success.

At {{ config('app.name') }}, we are committed to providing you with exceptional products/services and a memorable customer experience. We sincerely thank you for choosing us as your preferred Flight Ticketing provider.

Once again, happy birthday! May this year be filled with happiness, success, and wonderful experiences. We look forward to serving you and being a part of your journey in the coming year.

Warmest regards,
{{ config('app.name') }}
@endcomponent