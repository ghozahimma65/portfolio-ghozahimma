<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'school',
        'degree',
        'major',
        'start_date',
        'end_date',
        'description',
        'order',
    ];

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('educations_all');
        });
        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('educations_all');
        });
    }
}
