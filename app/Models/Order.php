<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'visit_date', 'session',
        'ticket_type', 'qty_adult', 'qty_child', 'price_per_ticket',
        'total_price', 'name', 'phone', 'email', 'notes',
        'status', 'payment_method',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }

    public function getSessionLabelAttribute(): string
    {
        return match($this->session) {
            1 => 'Sesi 1 — 08.00–11.00 WIB',
            2 => 'Sesi 2 — 11.00–14.00 WIB',
            3 => 'Sesi 3 — 14.00–17.00 WIB',
            default => '-',
        };
    }

    public function getTotalQtyAttribute(): int
    {
        return $this->qty_adult + $this->qty_child;
    }

    public static function generateOrderNumber(): string
    {
        do {
            $number = 'PDW-' . date('ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));
        } while (self::where('order_number', $number)->exists());

        return $number;
    }
}
