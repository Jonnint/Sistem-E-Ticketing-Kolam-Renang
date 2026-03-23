<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = ['order_id', 'code', 'qr_code', 'status'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public static function generateCode(): string
    {
        do {
            $code = 'TKT-' . strtoupper(bin2hex(random_bytes(5)));
        } while (self::where('code', $code)->exists());

        return $code;
    }
}
