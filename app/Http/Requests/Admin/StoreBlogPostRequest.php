<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreBlogPostRequest extends FormRequest
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
     * Validation rules for creating a new blog post.
     */
    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:255'],
            'slug'            => ['required', 'string', 'max:255', 'unique:blog_posts,slug', 'regex:/^[a-z0-9\-]+$/'],
            'content'         => ['required', 'string'],
            'category_id'     => ['nullable', 'exists:blog_categories,id'],
            'image'           => ['nullable', 'image', 'max:2048'],
            'status'          => ['required', Rule::in(['draft', 'published'])],
            'seo_title'       => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
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
