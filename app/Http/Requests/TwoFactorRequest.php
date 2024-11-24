<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TwoFactorRequest extends FormRequest
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
          'code' => 'required|digits:6', // Valida o código com 6 dígitos
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'O código é obrigatório.',
            'code.digits' => 'O código deve conter exatamente 6 dígitos.',
        ];
    }
}
