<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get all events for the user with tickets count
        $events = $user->events()
            ->withCount('tickets')
            ->latest()
            ->get();

        // Count upcoming events (events with date_time in the future)
        $upcomingEventsCount = $user->events()
            ->where('date_time', '>', Carbon::now())
            ->count();

        // Calculate total tickets across all events
        $totalTickets = $user->events()
            ->withCount('tickets')
            ->get()
            ->sum('tickets_count');

        return inertia('Dashboard', [
            'events' => $events,
            'upcomingEventsCount' => $upcomingEventsCount,
            'totalTickets' => $totalTickets,
        ]);
    }
}
