<?php
namespace App\Views\Composers;
use Illuminate\View\View;
use App\Post;
use App\Category;

class NavigationComposer
{
   // this code auto load
    public function compose(View $view)
    {
      $this->categories($view);
      $this->popular($view);
    }
    
   protected function categories(View $view)
   {
       $categories=  Category::with(['posts'=>function($query){
            $query->published();}
        ])->orderBy('title','desc')->get();
       $view->with('categories',$categories);
   }
   
   protected function popular(View $view)
   {
       $popularPosts=Post::published()->popular()->take(3)->get();
       $view->with('popularPosts',$popularPosts);
           
   }
}
 

 