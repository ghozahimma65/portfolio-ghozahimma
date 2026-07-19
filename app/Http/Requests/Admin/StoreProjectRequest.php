<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    /**
     * All admin panel users are already authenticated via middleware.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Auto-generate slug from title before validation runs.
     */
    protected function prepareForValidation(): void
    {
        if (! $this->filled('slug') && $this->filled('title')) {
            $this->merge(['slug' => Str::slug($this->title)]);
        }
    }

    /**
     * Validation rules for creating a new project.
     */
    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:255'],
            'slug'            => ['required', 'string', 'max:255', 'unique:projects,slug', 'regex:/^[a-z0-9\-]+$/'],
            'role'            => ['nullable', 'string', 'max:255'],
            'duration'        => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description'     => ['required', 'string'],
            'problem'         => ['nullable', 'string'],
            'solution'        => ['nullable', 'string'],
            'result'          => ['nullable', 'string'],
            'github_url'      => ['nullable', 'url'],
            'demo_url'        => ['nullable', 'url'],
            'tech_stack'      => ['required', 'array'],
            'tech_stack.*'    => ['string'],
            'features'        => ['nullable', 'array'],
            'features.*'      => ['string'],
            'thumbnail'       => ['nullable', 'image', 'max:2048'],
            'gallery'         => ['nullable', 'array'],
            'gallery.*'       => ['image', 'max:2048'],
            'featured'        => ['boolean'],
            'status'          => ['required', Rule::in(['draft', 'published'])],
            'seo_title'       => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
            'order'           => ['required', 'integer'],
        ];
    }

    /**
     * Custom error messages for slug validation.
     */
    public function messages(): array
    {
        return [
            'slug.regex' => 'The slug may only contain lowercase letters, numbers, and hyphens.',
        ];
    }
}
