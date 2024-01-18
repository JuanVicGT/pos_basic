<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // Required
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)],
            'role' => ['required', 'string', 'max:255'],

            // Optional
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'printer' => ['nullable', 'string', 'max:255'],
            'admin' => ['nullable', 'boolean'],
        ];
    }
}
