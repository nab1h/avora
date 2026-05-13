<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'address',
        'whatsup',
        'phone',
        'email',
        'status',
        'msg',
        'is_archive',
        'is_delete',
        'in_user',
    ];
}
