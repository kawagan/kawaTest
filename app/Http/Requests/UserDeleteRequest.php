<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserDeleteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //prevent delete User:Admin in function destroy in class userController
        // because when we delete user(conatin Posts) we will move them to user:admin
        return !($this->route('user')==config('blog_cms.admin_id') || $this->route('user')==auth()->user()->id);
    }
    public function forbiddenResponse()
    {
       // http response : forbidden
       
           session()->push('m','danger');
           session()->push('m','you can\'t delete admin or currenr user ' );   
       return redirect()->back();   
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
