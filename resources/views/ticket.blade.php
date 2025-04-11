<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ticket - {{ $ticket->event->name }}</title>
    <style>
        body {
            margin: 0;
            padding: 40px;
            font-family: Arial, sans-serif;
            background: #fff;
        }

        .ticket-container {
            max-width: 100%;
            width: 100%;
            height: auto;
            display: flex;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
        }

        .ticket-left {
            width: 75%;
            background: #2563eb;
            color: white;
            padding: 30px;
        }

        .ticket-right {
            width: 25%;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            border-left: 2px dashed #ccc;
        }

        .event-name {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .event-category {
            font-size: 14px;
            text-transform: uppercase;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        .ticket-details {
            margin-top: 15px;
        }

        .detail-item {
            margin-bottom: 10px;
        }

        .detail-label {
            font-size: 10px;
            text-transform: uppercase;
            opacity: 0.8;
        }

        .detail-value {
            font-size: 14px;
            font-weight: bold;
        }

        .ticket-footer {
            margin-top: 20px;
            font-size: 12px;
        }

        .qr-code {
            width: 140px;
            height: 140px;
            margin-bottom: 10px;
        }

        .qr-code img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .scan-text {
            font-size: 10px;
            color: #333;
            text-align: center;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }

            .ticket-container {
                page-break-inside: avoid;
                border: none;
            }

            .ticket-left {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="ticket-container">
        <!-- Left side -->
        <div class="ticket-left">
            <div class="event-category">Concert Ticket</div>
            <div class="event-name">{{ $ticket->event->name }}</div>

            <div class="ticket-details">
                <div class="detail-item">
                    <div class="detail-label">Date & Time</div>
                    <div class="detail-value">{{ $ticket->event->date_time->format('F j, Y') }} -
                        {{ $ticket->event->date_time->format('g:i A') }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Venue</div>
                    <div class="detail-value">{{ $ticket->event->venue }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Ticket Type</div>
                    <div class="detail-value">{{ $ticket->type ?: 'General Admission' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Ticket #</div>
                    <div class="detail-value">{{ $ticket->ticket_number }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Price</div>
                    <div class="detail-value">${{ number_format($ticket->price, 2) }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Seat</div>
                    <div class="detail-value">{{ $ticket->seat ?: 'Open Floor' }}</div>
                </div>
            </div>

            <div class="ticket-footer">
                EVENTIFY ID: {{ $ticket->id }}
            </div>
        </div>

        <!-- Right side -->
        <div class="ticket-right">
            <div class="qr-code">
                <img src="data:image/svg+xml;base64,{{ base64_encode($ticket->qr_code_svg) }}" alt="QR Code">
            </div>
            <div class="scan-text">Scan</div>
        </div>
    </div>
</body>

</html>
