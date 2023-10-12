<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/open-tickets', [TicketController::class, 'openIndex'])->name('open.tickets.index');
Route::get('/closed-tickets', [TicketController::class, 'closedIndex'])->name('closed.tickets.index');
Route::patch('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
