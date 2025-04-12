<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tick', function(){
    return view('dump');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    //Verify Ticket
    Route::get('/verify-ticket/{event}', [TicketController::class, 'index'])->name('verify-ticket');
    Route::post('/verify-ticket', [TicketController::class, 'verify']);


    //Choose event to scan
    Route::get('/events/scan', [EventController::class, 'scanEvent'])->name('scan-event');

    //Tickets
    Route::get('/events/tickets', [TicketController::class, 'eventTickets'])->name('events.tickets');
    Route::get('/events/tickets/{event}', [TicketController::class, 'showTickets'])->name('tickets');

    //Events
    Route::resource('events', EventController::class)->except(['show']);
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');





    //Download Ticket
    Route::get('/event/{event}/ticket/{ticket}/download', [TicketController::class, 'download'])->name('download');
    Route::get('/event/{event}/download', [TicketController::class, 'bulkDownload'])->name('bulk-download');

    //Print Ticket
    Route::get('/ticket/print/{ticket}', [TicketController::class, 'printTicket'])->name('print-ticket');

});

require __DIR__.'/auth.php';
