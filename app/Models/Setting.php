<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_title',
        'meta_description',
        'logo',
        'icon_180',
        'icon_32',
        'icon_16',
        'manifest',
        'address_en',
        'address_ar',
        'hours_en',
        'hours_ar',
        'facebook',
        'twitter',
        'instagram',
        'snapchat',
        'tiktok',
        'mobile',
        'whatsapp',
        'email',
        'map_link',
    ];
}
