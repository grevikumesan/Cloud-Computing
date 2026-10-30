<?php

use App\Mail\TicketRegistered;
use App\Models\TicketRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

test('registration form can be displayed', function () {
    $this->get(route('tickets.create'))
        ->assertOk()
        ->assertSee('Registrasi Tiket Konser');
});

test('ticket registration can be stored', function () {
    Mail::fake();

    $this->post(route('tickets.store'), [
        'name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'phone' => '081234567890',
        'category' => 'vip',
        'quantity' => 2,
    ])->assertRedirect(route('tickets.create'))
        ->assertSessionHas('success');

    expect(TicketRegistration::where('email', 'budi@example.com')->exists())->toBeTrue();

    Mail::assertSent(TicketRegistered::class, fn (TicketRegistered $mail) => $mail->hasTo('budi@example.com'));
});

test('registration email contains the ticket details', function () {
    $ticketRegistration = TicketRegistration::factory()->create(['category' => 'vip', 'quantity' => 2]);

    (new TicketRegistered($ticketRegistration))
        ->assertSeeInHtml($ticketRegistration->name)
        ->assertSeeInHtml('VIP')
        ->assertSeeInHtml('#'.$ticketRegistration->id);
});

test('invalid registration shows validation errors', function () {
    $this->post(route('tickets.store'), ['quantity' => 10])
        ->assertSessionHasErrors(['name', 'email', 'phone', 'category', 'quantity']);
});
