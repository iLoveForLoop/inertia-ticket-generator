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
            max-width: 800px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 10px;
            border-collapse: collapse;
            /* Ensure table renders correctly */
        }

        .ticket-row {
            width: 100%;
        }

        .ticket-left {
            width: 75%;
            background: #2d3036;
            color: white;
            padding: 30px;
            vertical-align: top;
            /* Align content to the top */
        }

        .ticket-right {
            width: 25%;
            background: #fff;
            padding: 20px;
            text-align: center;
            border-left: 2px dashed #ccc;
            vertical-align: middle;
            /* Center QR code vertically */
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
            font-size: 12px;
            margin-top: 20px;
        }

        .qr-code {
            width: 120px;
            height: 120px;
            margin: 0 auto;
        }

        .qr-code img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
        }

        .scan-text {
            font-size: 10px;
            color: #333;
            text-align: center;
            margin-top: 5px;
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

            .ticket-right {
                border-left: 2px dashed #ccc;
            }

            .qr-code img {
                display: block !important;
            }
        }
    </style>
</head>

<body>
    <table class="ticket-container">
        <tr class="ticket-row">
            <!-- Left side -->
            <td class="ticket-left">
                <div class="event-category">Event Ticket</div>
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
                        <div class="detail-label">Ticket #</div>
                        <div class="detail-value">{{ $ticket->ticket_number }}</div>
                    </div>
                </div>
                <div class="ticket-footer">
                    EVENTIFY ID: {{ $ticket->id }}
                </div>
            </td>

            <!-- Right side -->
            <td class="ticket-right">
                <div class="qr-code">
                    <img src="data:image/svg+xml;base64,{{ base64_encode($ticket->qr_code_svg) }}" alt="QR Code">
                </div>
                <div class="scan-text">Scan</div>
            </td>
        </tr>
    </table>
</body>

</html>
