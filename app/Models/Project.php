<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'role',
        'duration',
        'short_description',
        'description',
        'problem',
        'solution',
        'result',
        'github_url',
        'demo_url',
        'tech_stack',
        'features',
        'image_path',
        'gallery_images',
        'featured',
        'status',
        'seo_title',
        'seo_description',
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
            'tech_stack'     => 'array',
            'features'       => 'array',
            'gallery_images' => 'array',
            'featured'       => 'boolean',
        ];
    }

    /**
     * Override Route Model Binding to include soft-deleted records.
     * This allows the admin edit/update/restore screens to access trashed projects
     * without falling back to manual withTrashed()->findOrFail() in controllers.
     */
    public function resolveRouteBinding($value, $field = null): ?static
    {
        return $this->withTrashed()
            ->where($field ?? $this->getRouteKeyName(), $value)
            ->firstOrFail();
    }
}
