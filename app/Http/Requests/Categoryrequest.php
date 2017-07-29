<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Categoryrequest extends Request
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

        $rules= [
            "title"=>"required",
            "slug"=>"required|unique:categories,slug"
        ];
       
        switch ($this->method()){
            case "PUT":
            case "PACTCH":
                $rules['slug']="required|unique:categories,slug,id";
                break;
        };
        
        return $rules;
    }
}
