<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportStoreRequest extends FormRequest
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
            'admin' => ['required'],
            'naziv' => ['required', 'string', 'max:150'],
            'period_od' => ['required', 'date'],
            'period_do' => ['required', 'date'],
            'datum_kreiranja' => ['required', 'date'],
        ];
    }
}
