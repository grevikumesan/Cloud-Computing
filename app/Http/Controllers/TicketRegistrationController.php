<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRegistrationRequest;
use App\Models\TicketRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketRegistrationController extends Controller
{
    /**
     * Show the ticket registration form.
     */
    public function create(): View
    {
        return view('tickets.create', [
            'categories' => TicketRegistration::CATEGORIES,
        ]);
    }

    /**
     * Store a new ticket registration.
     */
    public function store(StoreTicketRegistrationRequest $request): RedirectResponse
    {
        TicketRegistration::create($request->validated());

        return redirect()
            ->route('tickets.create')
            ->with('success', 'Registrasi berhasil! Detail tiket akan dikirim ke email kamu.');
    }
}
