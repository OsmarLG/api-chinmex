<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $emailRule = app()->environment('production')
            ? 'required|email:rfc,dns|exists:users,email'
            : 'required|email|exists:users,email';

        return [
            'email' => $emailRule,
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'El email es requerido.',
            'email.email' => 'El email debe tener un formato válido.',
            'email.exists' => 'Este email no está registrado.',
        ];
    }
}
