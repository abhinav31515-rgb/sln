<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'               => ['required', 'string', 'max:255'],
            'discount_percentage' => ['required', 'integer', 'min:1', 'max:100'],
            'discount_code'       => ['nullable', 'string', 'max:50', 'unique:offers,discount_code'],
            'valid_until'         => ['required', 'date', 'after:today'],
        ];
    }
}
