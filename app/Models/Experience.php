<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'company',
        'location',
        'start_date',
        'end_date',
        'current_position',
        'responsibilities',
        'achievements',
        'tech_stack',
        'logo',
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
            'responsibilities' => 'array',
            'achievements' => 'array',
            'tech_stack' => 'array',
            'current_position' => 'boolean',
        ];
    }

    /**
     * Accessor for logo: resolves stored relative path to a public URL.
     */
    protected function logo(): Attribute
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
