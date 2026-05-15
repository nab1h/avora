<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'path',
        'thumbnail',
        'title',
        'order_column',
        'is_active',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order_column', 'asc');
    }

    public function scopeActiveHero($query)
    {
        return $query->where('is_active', true)
            ->whereIn('type', ['hero_video', 'hero_image'])
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
