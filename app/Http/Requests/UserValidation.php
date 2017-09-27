<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class UserValidation extends FormRequest
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
        if( $this->method() == 'PATCH' && empty(Input::has('password')) ){
            return [
                'name' => 'required|max:255',
                'role' => 'required',
                'email' => 'required|email|max:255|unique:users,email,' . Input::get('id'),
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ];
        } else{
            return [
                'name' => 'required|max:255',
                'role' => 'required',
                'email' => 'required|email|max:255|unique:users,email,' . Input::get('id'),
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'password' => 'confirmed|min:6',
            ];
        }




    }
}
