<?php

namespace Modules\MasterCabang\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MasterCabangStoreUpdateRequest extends FormRequest
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
            'kodecabang' => 'required',
            'namacabang' => 'required',
            'kodeinduk' => 'required',
            'kodekanwil' => 'required',
            'status' => 'required',
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
            'kodecabang.required' => __('validation.required', ['attribute' => 'Kode Cabang']),
            'namacabang.required' => __('validation.required', ['attribute' => 'Nama Cabang']),
            'kodeinduk.required' => __('validation.required', ['attribute' => 'Cabang Induk']),
            'kodekanwil.required' => __('validation.required', ['attribute' => 'Kanwil']),
            'status.required' => __('validation.required', ['attribute' => 'Status']),
            ];
    }
}
