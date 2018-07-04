<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        dd($this->id);
        return [
            'name'      => 'required',
            'username'  => 'required|unique:users,username,' . $this->user,
            'email'     => 'required|unique:users,email,'. $this->user
        ];
    }
}
