<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class SliderValidation extends FormRequest
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
        if( $this->method() == 'PATCH' && empty(Input::has('image')) ) {
            return [
                'title' => 'required|max:255',
                'position' => 'required',
                'type' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,JPG,gif,svg|max:1024',
            ];
        } else{
            return [
                'title' => 'required|max:255',
                'position' => 'required',
                'type' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,JPG,svg|max:1024',
            ];
        }
    }
}
