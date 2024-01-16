<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'is_admin' => ['nullable', 'boolean'],

            'can_category' => ['nullable', 'boolean'],
            'can_customer' => ['nullable', 'boolean'],
            'can_employee' => ['nullable', 'boolean'],
            'can_expense' => ['nullable', 'boolean'],
            'can_pos' => ['nullable', 'boolean'],
            'can_ppos' => ['nullable', 'boolean'],
            'can_sale' => ['nullable', 'boolean'],
            'can_purchase' => ['nullable', 'boolean'],
            'can_paysalary' => ['nullable', 'boolean'],
            'can_product' => ['nullable', 'boolean'],
            'can_supplier' => ['nullable', 'boolean']
        ];
    }
}
