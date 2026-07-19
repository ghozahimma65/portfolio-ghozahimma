<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'icon',
        'url',
        'order',
    ];

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('social_links_all');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('social_links_all');
        });
    }
}
