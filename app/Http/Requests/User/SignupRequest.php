<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
        return [
            'first_name' => ['required','max:255'],
            'last_name' => ['required','max:255'],
            'email' => ['required','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix','unique:users','max:255'],
            'password' => ['required','min:4','max:50'],
            'is_promo' => ['required','boolean'],
            'is_product_update' => ['required','boolean']
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
