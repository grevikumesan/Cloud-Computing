<?php

use App\Models\TicketRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('registration form can be displayed', function () {
    $this->get(route('tickets.create'))
        ->assertOk()
        ->assertSee('Registrasi Tiket Konser');
});

test('ticket registration can be stored', function () {
    $this->post(route('tickets.store'), [
        'name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'phone' => '081234567890',
        'category' => 'vip',
        'quantity' => 2,
    ])->assertRedirect(route('tickets.create'))
        ->assertSessionHas('success');

    expect(TicketRegistration::where('email', 'budi@example.com')->exists())->toBeTrue();
});

test('invalid registration shows validation errors', function () {
    $this->post(route('tickets.store'), ['quantity' => 10])
        ->assertSessionHasErrors(['name', 'email', 'phone', 'category', 'quantity']);
});
