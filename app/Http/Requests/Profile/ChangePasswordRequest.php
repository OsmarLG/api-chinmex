<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('La contraseña actual es incorrecta.');
                    }
                },
            ],
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required|string|min:8',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'current_password.required' => 'La contraseña actual es requerida.',
            'current_password.string' => 'La contraseña actual debe ser una cadena de texto.',
            'new_password.required' => 'La nueva contraseña es requerida.',
            'new_password.string' => 'La nueva contraseña debe ser una cadena de texto.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'new_password.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
            'new_password_confirmation.required' => 'La confirmación de la nueva contraseña es requerida.',
            'new_password_confirmation.string' => 'La confirmación de la nueva contraseña debe ser una cadena de texto.',
            'new_password_confirmation.min' => 'La confirmación de la nueva contraseña debe tener al menos 8 caracteres.',
        ];
    }
}