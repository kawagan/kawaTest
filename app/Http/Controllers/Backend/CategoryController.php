<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use DB;
use App\Post;

class CategoryController extends BackendController
{
  
    public function index()
    {
        $categories= Category::with(['posts'=>function($query){
            $query->withTrashed();
        }])->orderBy('created_at','desc')->paginate($this->limit);
        
        $categoryCount=Category::count();
        return  view('backend.category.index',compact('categories','categoryCount'));
    }
   
    public function create(Category $category)
    {
        //$category=new Category();
        return view('backend.category.add_category',compact('category'));
    }

   
    public function store(Requests\Categoryrequest $request)
    {
        Category::create($request->all());
      
        session()->push('m','success');
        session()->push('m','The category has created successfully');
        
        return redirect('/backend/category');
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $category=Category::findOrFail($id);
        return view('backend.category.edit_category',compact('category'));
    }

  
    public function update(Request $request, $id)
    {
        
        Category::findOrFail($id)->update($request->all());
        
        session()->push('m','success');
        session()->push('m','The category has updated successfully');
        
        return redirect()->route('backend.category.index');
    }

   
    public function destroy(Requests\CategoryDeleteRequest $request,$id)
    {
        Post::withTrashed()->where('category_id',$id)->
                update(['category_id'=>config('blog_cms.uncategorized_id')]);
        
        Category::findOrFail($id)->delete();
        
        session()->push('m','success');
        session()->push('m','The post has deleted successfully');
        
        return redirect('/backend/category');
        
    }
    
}
