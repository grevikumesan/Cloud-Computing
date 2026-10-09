<?php

namespace App\Models;

use Database\Factories\TicketRegistrationFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'category', 'quantity'])]
class TicketRegistration extends Model
{
    /** @use HasFactory<TicketRegistrationFactory> */
    use HasFactory;

    /**
     * Available ticket categories.
     *
     * @var array<string, string>
     */
    public const CATEGORIES = [
        'festival' => 'Festival — Rp750.000',
        'tribune' => 'Tribun — Rp1.000.000',
        'vip' => 'VIP — Rp2.500.000',
    ];
}
