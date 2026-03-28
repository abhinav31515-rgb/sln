<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageSeoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string'],
            'og_title'        => ['nullable', 'string'],
            'og_description'  => ['nullable', 'string'],
            'og_image'        => ['nullable', 'string', 'url'],
            'twitter_card'    => ['nullable', 'string'],
            'json_ld'         => ['nullable', 'string', function (string $attribute, mixed $value, \Closure $fail) {
                if ($value !== null && json_decode($value) === null && json_last_error() !== JSON_ERROR_NONE) {
                    $fail("The {$attribute} must be a valid JSON string.");
                }
            }],
            'llm_summary'     => ['nullable', 'string'],
            'llm_keywords'    => ['nullable', 'string'],
            'canonical_url'   => ['nullable', 'url'],
            'robots'          => ['nullable', 'string'],
        ];
    }
}
