<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'issuer',
        'issue_date',
        'image_path',
        'credential_url',
        'category',
        'featured',
        'order',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
        ];
    }

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
