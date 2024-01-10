<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        if(request()->isMethod('post')){
        return [
            'name'=>'required|string|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2055',
            'description'=>'required|string'
        ];
    }else{
        return [
            'name'=>'required|string|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2055',
            'description'=>'required|string'
        ];
    }
 }

 public function messages(){

    if(request()->isMethod('post')){

        return [
            'name.required'=>'Name is required',
            'image.required'=>'Image is required',
            'description.required'=>'Description is required',
           
        ];
    }else{
        return [
            'name.required'=>'Name is required',
            'description.required'=>'Description is required'
        ];
    }
    
 }

}
