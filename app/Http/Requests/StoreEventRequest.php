<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // L'autorisation est gérée par le middleware admin
    }

    public function rules(): array
    {
        return [
            'aa_title' => 'required|string|max:255',
            'aa_description' => 'required|string',
            'aa_start_date' => 'required|date',
            'aa_end_date' => 'required|date|after:aa_start_date',
            'aa_place' => 'required|string',
            'aa_price' => 'required_if:aa_is_free,0|nullable|numeric|min:0',
            'aa_capacity' => 'required|integer|min:1',
            'aa_category_id' => 'required|exists:aa_categories,aa_id',
            'aa_is_free' => 'required|boolean',
            'aa_image' => 'nullable|image|max:2048',
        ];
    }

    // Messages personnalisés
    public function messages(): array
    {
        return [
            'aa_title.required' => 'Le titre est obligatoire.',
            'aa_start_date.required' => 'La date de début est obligatoire.',
            'aa_end_date.required' => 'La date de fin est obligatoire.',
            'aa_place.required' => 'Le lieu est obligatoire.',
            'aa_price.required' => 'Le prix est obligatoire.',
            'aa_capacity.required' => 'La capacité est obligatoire.',
            'aa_category_id.required' => 'La catégorie est obligatoire.',    
            'aa_end_date.after' => 'La date de fin doit être après la date de début.',
           
        ];
    }
}
