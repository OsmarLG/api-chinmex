<?php

namespace App\Http\Requests\UserAddress;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserAddressRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
            'postal_code' => 'required|string|max:20',
            'country_id' => 'required|exists:countries,id',
            'is_default' => 'boolean',
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
            'user_id.required' => 'El ID del usuario es requerido.',
            'user_id.exists' => 'El usuario especificado no existe.',
            'address_line_1.required' => 'La línea de dirección 1 es requerida.',
            'address_line_1.string' => 'La línea de dirección 1 debe ser una cadena de texto.',
            'address_line_1.max' => 'La línea de dirección 1 no puede exceder 255 caracteres.',
            'address_line_2.string' => 'La línea de dirección 2 debe ser una cadena de texto.',
            'address_line_2.max' => 'La línea de dirección 2 no puede exceder 255 caracteres.',
            'city.required' => 'La ciudad es requerida.',
            'city.string' => 'La ciudad debe ser una cadena de texto.',
            'city.max' => 'La ciudad no puede exceder 255 caracteres.',
            'state_id.required' => 'El estado es requerido.',
            'state_id.exists' => 'El estado especificado no existe.',
            'postal_code.required' => 'El código postal es requerido.',
            'postal_code.string' => 'El código postal debe ser una cadena de texto.',
            'postal_code.max' => 'El código postal no puede exceder 20 caracteres.',
            'country_id.required' => 'El país es requerido.',
            'country_id.exists' => 'El país especificado no existe.',
            'is_default.boolean' => 'El campo por defecto debe ser verdadero o falso.',
        ];
    }
}