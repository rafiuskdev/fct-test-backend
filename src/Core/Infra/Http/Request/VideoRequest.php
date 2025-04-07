<?php

namespace Core\Infra\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
          'query' => ['nullable', 'string'],
          'page' => ['required', 'numeric'],
          'per_page' => ['required', 'numeric'],
          'locale' => ['nullable', 'string'],
          'size' => ['nullable', 'string'],
          'is_popular' => ['required', 'boolean'],
          'orientation' => ['nullable', 'string'],
        ];
    }
}
