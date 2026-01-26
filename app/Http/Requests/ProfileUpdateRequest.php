<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            'aa_name' => ['required', 'string', 'max:255'],
            'aa_email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class, 'aa_email')->ignore($this->user()->aa_id, 'aa_id'),
            ],
        ];
    }
}
