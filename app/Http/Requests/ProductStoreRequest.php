<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:Category,id'],
            'naziv' => ['required', 'string', 'max:150'],
            'opis' => ['nullable', 'string'],
            'tip_vode' => ['required', 'string', 'max:50'],
            'ambalaza' => ['required', 'string', 'max:50'],
            'cena' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
        ];
    }
}
