<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'min:2|max:255',
            'description' => 'max:1000',
            'pictures' => 'array|min:1',
            'pictures.*' => ['url', 'regex:~^https?://(?:[a-z0-9\-]+\.)+[a-z]{2,6}(?:/[^/#?]+)+\.(?:jpe?g|jpg|png)$~'],
        ];
    }
}
