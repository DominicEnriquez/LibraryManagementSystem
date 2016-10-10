<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
        $rules = [
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|min:6|confirmed',
            
            'contact_number' => 'required|min:7|max:20',
            'firstname' => 'required|min:3|max:60',
            'lastname' => 'required|min:3|max:60',
            'middlename' => 'min:1|max:60',
            'address' => 'required|min:3|max:200',
            'gender' => ['required', 'regex:/^((male)|(female))$/i'],
            'birthdate' => 'required|date_format:Y-m-d',
        ];
        
        if (\Route::currentRouteName() == 'admin::do-member-edit') {
            unset($rules['email']);
            unset($rules['password']);
        }
        
        return $rules;
    }
}
