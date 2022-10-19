<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nameEdit' => 'max:30|required',
            'usernameEdit' => 'required',
            'divisionEdit' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nameEdit.required' => 'Nama tidak boleh kosong',
            'nameEdit.max' => 'Nama maksimal :max karakter',
            'usernameEdit.required' => 'Username tidak bisa diubah',
            'divisionEdit' => 'Divisi Wajib Diganti'
        ];
    }
}
