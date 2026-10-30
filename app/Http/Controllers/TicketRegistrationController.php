<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRegistrationRequest;
use App\Mail\TicketRegistered;
use App\Models\TicketRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

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
     * Store a new ticket registration and email the details to the registrant.
     */
    public function store(StoreTicketRegistrationRequest $request): RedirectResponse
    {
        $ticketRegistration = TicketRegistration::create($request->validated());

        try {
            Mail::to($ticketRegistration->email)->send(new TicketRegistered($ticketRegistration));
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->route('tickets.create')
                ->with('success', 'Registrasi berhasil disimpan, tapi email konfirmasi gagal dikirim.');
        }

        return redirect()
            ->route('tickets.create')
            ->with('success', 'Registrasi berhasil! Detail tiket sudah dikirim ke email kamu.');
    }
}
