<!DOCTYPE html>
<html>

<head>
    <title>Ticket - {{ $ticket->event->name }}</title>
    <style>
        /* Add your ticket styling here */
    </style>
</head>

<body>
    <div class="ticket-container">
        <h1>{{ $ticket->event->name }}</h1>
        <p>Date: {{ $ticket->event->date_time->format('F j, Y g:i A') }}</p>
        <p>Venue: {{ $ticket->event->venue }}</p>
        <p>Ticket #: {{ $ticket->ticket_number }}</p>
        <img src="data:image/svg+xml;base64,{{ base64_encode($ticket->qr_code_svg) }}" alt="QR Code">

        <p>Scan this QR code at the event entrance</p>
    </div>
</body>

</html>
