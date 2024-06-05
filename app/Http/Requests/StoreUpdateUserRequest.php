<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(3);

        $rules = [
            'name' => 'required|string|min:5|max:255',
            'email' => "required|min:3|max:255|unique:users,email,{$id},id",
            'password' => 'required|min:6|max:20|confirmed',
        ];

        if ($this->method() == 'PUT' ) {
            $rules['password'] = ['nullable', 'min:6', 'max:20'];
        }

        return $rules;

    }
}
