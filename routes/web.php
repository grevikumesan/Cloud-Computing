<?php

use App\Http\Controllers\TicketRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TicketRegistrationController::class, 'create'])->name('tickets.create');
Route::post('/tickets', [TicketRegistrationController::class, 'store'])->name('tickets.store');
