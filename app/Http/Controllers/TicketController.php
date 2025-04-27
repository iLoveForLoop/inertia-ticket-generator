<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Event;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use ZipArchive;

class TicketController extends Controller
{
    use AuthorizesRequests;
    public function index(Event $event){

        return inertia('VerifyTicket/VerifyTicket', compact('event'));
    }

    public function verify(Request $request)
    {
        $ticketNumber = $request->input('ticket_number');
        $eventId = $request->input('event_id');
        $event = Event::findOrFail($eventId);

        $ticket = Ticket::where('ticket_number', $ticketNumber)
                    ->where('event_id', $event->id)
                    ->first();

        // dd($ticket->is_scanned);
        if (!$ticket) {
            // return response()->json(['valid' => false, 'message' => 'Invalid ticket']);
            return back()->with('error', 'Invalid Ticket');
        }

        if ($ticket->is_scanned) {
            return back()
            ->with('error', 'Ticket already scanned at ' . $ticket->scanned_at->format('Y-m-d H:i:s'));
        }

        $ticket->update([
            'is_scanned' => true,
            'scanned_at' => now(),
        ]);

        return back()
            ->with('success', 'Ticket verified successfully for event "' . $ticket->event->name . '" at ' . $ticket->event->venue . ' on ' . $ticket->scanned_at->format('Y-m-d H:i:s'));

    }

    public function download(Event $event, Ticket $ticket)
{
    $this->authorize('view', $event);



    // dd($ticket->qr_code_svg);
    // dd($qrCode);

    $ticket->load('event');
    $pdf = Pdf::loadView('ticket', compact('ticket'));


    return response($pdf->output(), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="ticket-' . $ticket->ticket_number . '.pdf"',
    ]);
}

public function bulkDownload(Event $event)
{
    $this->authorize('view', $event);

    $zip = new ZipArchive;
    $zipFileName = storage_path("app/public/{$event->name}-tickets.zip");

    if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
        foreach ($event->tickets as $ticket) {
            $qrCode = QrCode::format('svg')
                ->size(200)
                ->generate($ticket->ticket_number);
            // dd($qrCode);


            $ticket->load('event');
            $pdf = Pdf::loadView('ticket', compact('ticket'));
            $pdfPath = storage_path("app/public/temp/ticket-{$ticket->ticket_number}.pdf");
            $pdf->save($pdfPath);
            $zip->addFile($pdfPath, "ticket-{$ticket->ticket_number}.pdf");
        }
        $zip->close();


        foreach ($event->tickets as $ticket) {
            unlink(storage_path("app/public/temp/ticket-{$ticket->ticket_number}.pdf"));
        }

        return response()->download($zipFileName)->deleteFileAfterSend(true);
    }

    return back()->with('error', 'Failed to create zip file');
}


public function printTicket(Ticket $ticket)
{
    $pdf = PDF::loadView('ticket', compact('ticket'));
    return $pdf->stream('ticket.pdf');
}



//Showing
public function eventTickets(Request $request)
{
    $search = $request->input('search');
    $events = auth()->user()->events()
        ->latest()
        ->withCount('tickets')
        ->when($search, fn($query, $search) =>
            $query->where('name', 'like', "%{$search}%")
        )
        ->get();

    return inertia('Tickets/Events', [
        'events' => $events->map(function ($event) {
            return [
                'id' => $event->id,
                'name' => $event->name,
                'description' => $event->description,
                'date_time' => $event->date_time,
                'formatted_date' => $event->date_time->format('M d, Y h:i A'),
                'venue' => $event->venue,
                'ticket_capacity' => $event->ticket_capacity,
                'tickets_count' => $event->tickets_count ?? 0,
                'image_url' => $event->image_path ? asset('storage/'.$event->image_path) : null,
                'is_upcoming' => $event->date_time > now(),
            ];
        }), 'search' => $search
    ]);
}

    public function showTickets(Event $event){
        $filter = request('filter', 'all');
        $ticketsQuery = $event->tickets();

        if($filter === 'scanned'){
            $ticketsQuery->where('is_scanned', true);
        } elseif($filter === 'not_scanned'){
            $ticketsQuery->where('is_scanned', false);
        }

        $tickets = $ticketsQuery->paginate(7)->withQueryString();
        return inertia('Tickets/Index', compact('event', 'tickets', 'filter'));
    }


}