<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
{
    /**
     * All admin panel users are already authenticated via middleware.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating a new experience record.
     */
    public function rules(): array
    {
        return [
            'role'              => ['required', 'string', 'max:255'],
            'company'           => ['required', 'string', 'max:255'],
            'location'          => ['nullable', 'string', 'max:255'],
            'start_date'        => ['required', 'string', 'max:255'],
            'end_date'          => ['required', 'string', 'max:255'],
            'current_position'  => ['boolean'],
            'responsibilities'  => ['required', 'array'],
            'responsibilities.*' => ['string'],
            'achievements'      => ['nullable', 'array'],
            'achievements.*'    => ['string'],
            'tech_stack'        => ['nullable', 'array'],
            'tech_stack.*'      => ['string'],
            'logo'              => ['nullable', 'image', 'max:2048'],
            'order'             => ['required', 'integer'],
        ];
    }
}
