<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required|min:8|unique:users,username',
            'password' => 'required',
            'division' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nama Wajib Diisi',
            'username.required' => 'Username Wajib Diisi',
            'username.min' => 'Username Wajib 8 Karakter',
            'username.unique' => 'Username sudah digunakan',
            'division' => 'Divisi Wajib Diisi'
        ];
    }
}
