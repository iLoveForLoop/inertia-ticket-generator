<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class EventController extends Controller
{
    use AuthorizesRequests; // Add this trait

    public function index(Request $request){

        $search = $request->input('search');
        $events = auth()->user()->events()
        ->latest()
        ->when($search, fn($query, $search) =>
            $query->where('name', 'like', "%{$search}%")
        )
        ->get();

    return inertia('Events/Index', compact('events', 'search'));
    }

    public function create(){
        return inertia('Events/Create');
    }

    public function store(Request $request){

        set_time_limit(3000);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_time' => 'required|date',
            'venue' => 'required|string|max:255',
            'ticket_capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);


        if($request->hasFile('image')){
            $path = $request->file('image')->store('event-images', 'public');
            $validated['image_path'] = $path;
        }

        $event = auth()->user()->events()->create($validated);


        for($i = 0; $i < $event->ticket_capacity; $i++){

            $ticketNumber = Str::uuid();
            $svg = QrCode::format('svg')
            ->size(200)
            ->generate($ticketNumber);

            // dd($svg);


            $event->tickets()->create([
                'ticket_number' => $ticketNumber,
                'qr_code_svg' => $svg
            ]);


        }

        return redirect()->route('events.show', $event->id);
    }

    public function show(Event $event){
        $this->authorize('view', $event);

        $event->load('tickets');

        return inertia('Events/Show', compact('event'));
    }

    public function edit(Event $event){
        $this->authorize('update', $event); // Add authorization here too
        return inertia('Events/Edit', compact('event')); // Don't forget to pass the event
    }

    public function update(Request $request, Event $event){
        $this->authorize('update', $event);

        // dd($request->all());
        // dd($request->name);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_time' => 'required|date',
            'venue' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);





        if($request->hasFile('image')){
            if($event->image_path){
                Storage::disk('public')->delete($event->image_path);
            }
            $path = $request->file('image')->store('event-images', 'public');
            $validated['image_path'] = $path;
        }

        $event->update($validated);
        return redirect()->route('events.show', $event->id);
    }

    public function destroy(Event $event){
        $this->authorize('delete', $event);

        // Delete event image if exists
        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }

        $event->delete();
        return redirect()->route('events.index');
    }


    public function scanEvent(){
        $search = request('search');
        $events = auth()->user()
        ->events()
        ->latest()
        ->when($search, fn($query, $search) =>
        $query->where('name', 'like', "%{$search}%")
    )->get();

        return inertia('VerifyTicket/VerifyEvent', compact('events', 'search'));
    }
}