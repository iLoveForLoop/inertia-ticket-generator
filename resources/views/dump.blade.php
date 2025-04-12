<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ticket</title>
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
            /* display: flex; */
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            display: flex
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
            background-color: black
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
            <div class="event-name">Multo</div>

            <div class="ticket-details">
                <div class="detail-item">
                    <div class="detail-label">Date & Time</div>
                    <div class="detail-value">Dummy Date</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Venue</div>
                    <div class="detail-value">Venue</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Ticket #</div>
                    <div class="detail-value">143 mikyla</div>
                </div>
            </div>

            <div class="ticket-footer">
                EVENTIFY ID: 11111
            </div>
        </div>

        <!-- Right side -->
        <div class="ticket-right">
            <div class="qr-code">
                {{-- <img src="data:image/svg+xml;base64,{{ base64_encode($ticket->qr_code_svg) }}" alt="QR Code"> --}}
            </div>
            <div class="scan-text">Scan</div>
        </div>
    </div>
</body>

</html>
