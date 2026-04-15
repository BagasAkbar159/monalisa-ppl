<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->driver->user_id;

        return [
            // Data untuk tabel users
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],

            // Data untuk tabel drivers
            'license_number' => ['required', 'string', 'max:100'],
            'license_type' => ['nullable', 'string', 'max:20'],
            'license_expiry_date' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'status' => ['required', 'in:available,on_delivery,inactive'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}