<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserUpdateRequest extends Request
{
    
    public function authorize()
    {
      
        return true;
    }
    
    
    public function rules()
    {
        return [
            "name"=>"required",
            "email"=>"required|email|unique:users,email,".$this->route('user'),
            "password"=>"required_with:password_confirmation|confirmed",
            "role"=>"required",
            "slug"=>"required|unique:users,slug,".$this->route('user')
        ];
    }
}
