<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryDeleteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //prevent delete category:uncategorized in function destroy in class categoryController
        // because when we delete category(conatin Posts) we will move them to category:uncategorized
        return !($this->route('category')==config('blog_cms.uncategorized_id'));
    }
    public function forbiddenResponse()
    {
       session()->push('m','danger');
       session()->push('m','you can\'t delete uncategorized category ' );
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
