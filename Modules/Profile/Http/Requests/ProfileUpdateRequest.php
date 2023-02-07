<?php

namespace Modules\Profile\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|min:8',
            'npassword' => 'required|min:8',
            'kpassword' => 'required|min:8',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'old_password.required' => __('validation.required', ['attribute' => 'Password Lama']),
            'npassword.required' => __('validation.required', ['attribute' => 'Password Baru']),
            'kpassword.required' => __('validation.required', ['attribute' => 'Konfirmasi Password Baru']),
            'old_password.min' => __('validation.min', ['attribute' => 'Password Lama']),
            'npassword.min' => __('validation.min', ['attribute' => 'Password Baru']),
            'kpassword.min' => __('validation.min', ['attribute' => 'Konfirmasi Password Baru']),
            ];
    }
}
