<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:255'],
            'category_id'      => ['required', 'integer', 'exists:categories,id'],
            'duration_minutes' => ['required', 'integer', 'min:1', 'max:480'],
            'price'            => ['required', 'numeric', 'min:0'],
        ];
    }
}
