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
     * Get the validated thumbnail URL.
     */
    public function getThumbnailUrlAttribute(): string
    {
        $path = $this->image_path;

        if (empty($path)) {
            return asset('assets/images/project-placeholder.png');
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Clean storage/ prefix if present
        $cleanPath = $path;
        if (str_starts_with($path, 'storage/')) {
            $cleanPath = substr($path, 8); // remove 'storage/'
        }

        if (Storage::disk('public')->exists($cleanPath)) {
            return Storage::disk('public')->url($cleanPath);
        }

        // If it starts with assets/ check if it exists in public
        if (str_starts_with($path, 'assets/')) {
            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }

        // Default placeholder fallback
        return asset('assets/images/project-placeholder.png');
    }

    /**
     * Get validated gallery image URLs.
     */
    public function getGalleryUrlsAttribute(): array
    {
        $gallery = $this->gallery_images;
        if (empty($gallery) || !is_array($gallery)) {
            return [];
        }

        $urls = [];
        foreach ($gallery as $img) {
            if (empty($img)) {
                continue;
            }

            if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
                $urls[] = $img;
                continue;
            }

            // Clean storage/ prefix if present
            $cleanImg = $img;
            if (str_starts_with($img, 'storage/')) {
                $cleanImg = substr($img, 8);
            }

            if (Storage::disk('public')->exists($cleanImg)) {
                $urls[] = Storage::disk('public')->url($cleanImg);
            } elseif (str_starts_with($img, 'assets/')) {
                if (file_exists(public_path($img))) {
                    $urls[] = asset($img);
                }
            }
        }

        return $urls;
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
