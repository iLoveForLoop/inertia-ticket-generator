<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get events with ticket counts and scanned ticket counts
        $events = $user->events()
            ->withCount(['tickets', 'tickets as scanned_tickets_count' => function($query) {
                $query->where('is_scanned', true);
            }])
            ->latest()
            ->paginate(3); // Paginate for better performance

        // Get statistics
        $stats = [
            'total_events' => $user->events()->count(),
            'upcoming_events' => $user->events()
                ->where('date_time', '>', Carbon::now())
                ->count(),
            'total_tickets' => $user->events()
                ->withCount('tickets')
                ->get()
                ->sum('tickets_count'),
            'scanned_tickets' => $user->events()
                ->withCount(['tickets' => function($query) {
                    $query->where('is_scanned', true);
                }])
                ->get()
                ->sum('tickets_count'),
            'recent_activity' => Ticket::where('is_scanned', true)
                ->whereIn('event_id', $user->events()->pluck('id'))
                ->with('event')
                ->latest('scanned_at')
                ->limit(5)
                ->get()

        ];

        // $stats["recent_activity"]->load("event");
        return Inertia::render('Dashboard', [
            'events' => $events,
            'stats' => $stats,
            'filters' => request()->only(['search'])
        ]);
    }
}
