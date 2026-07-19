<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Award extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'issuer',
        'year',
        'description',
        'image_path',
        'order',
    ];

    /**
     * Accessor for image_path: resolves stored relative path to a public URL.
     */
    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (empty($value)) {
                    return $value;
                }
                if (str_starts_with($value, 'http') || str_starts_with($value, 'assets/')) {
                    return $value;
                }
                if (str_starts_with($value, 'storage/')) {
                    return $value;
                }
                return ltrim(Storage::disk('public')->url($value), '/');
            }
        );
    }
}
