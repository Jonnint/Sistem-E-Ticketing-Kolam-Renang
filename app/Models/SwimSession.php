<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwimSession extends Model
{
    protected $fillable = ['name', 'start_time', 'end_time', 'price', 'quota', 'is_active'];
}
