<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategorySectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'  => ['required', 'integer', 'exists:categories,id'],
            'heading'      => ['required', 'string', 'max:255'],
            'sub_heading'  => ['nullable', 'string', 'max:255'],
            'layout'       => ['required', 'in:grid,carousel,list'],
            'sort_order'   => ['nullable', 'integer', 'min:0'],
            'is_visible'   => ['nullable', 'boolean'],
            'service_ids'  => ['nullable', 'array'],
            'service_ids.*' => ['integer', 'exists:services,id'],
        ];
    }
}
