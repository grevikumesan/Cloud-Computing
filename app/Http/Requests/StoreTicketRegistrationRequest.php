<?php

namespace App\Http\Requests;

use App\Models\TicketRegistration;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTicketRegistrationRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['required', 'regex:/^08[0-9]{8,12}$/'],
            'category' => ['required', Rule::in(array_keys(TicketRegistration::CATEGORIES))],
            'quantity' => ['required', 'integer', 'min:1', 'max:4'],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'phone.regex' => 'Nomor HP tidak valid, contoh: 081234567890.',
            'category.required' => 'Pilih kategori tiket.',
            'category.in' => 'Kategori tiket tidak tersedia.',
            'quantity.min' => 'Minimal 1 tiket.',
            'quantity.max' => 'Maksimal 4 tiket.',
        ];
    }
}
