<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'filepath',
        'file_type',
        'file_size',
    ];

    /**
     * Accessor for filepath: resolves stored relative path to a public URL.
     */
    protected function filepath(): Attribute
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
