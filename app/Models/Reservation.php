<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'guests',
        'reservation_date',
        'reservation_time',
        'status',
        'notes',
        'is_archive',
        'is_delete',
    ];

    protected $casts = [
        'reservation_time' => 'datetime:H:i',
    ];
}
