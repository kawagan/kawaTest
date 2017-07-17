<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use App\Category;
use DB;
use Carbon\Carbon;
use App\User;

class BlogController extends Controller
{
    protected $limit=3;
    public function getIndex()
    {
        //$posts=Post::with('author')->latestFirst()->get();
     
          $posts=Post::with('author')->
                  published()->latestFirst()->
                  simplePaginate($this->limit);
          
       
           // i have put this code in providers/ComposerserviceProvider
          /*$categories=  Category::with(['posts'=>function($query){
            $query->where('published_at','<=',Carbon::now());
        }])->orderBy('title','desc')->get();
           */
        
        /*
        \DB::enableQueryLog();
        $posts=Post::all();
        view('blog.index',  compact('posts'))->render();
        dd(\DB::getQueryLog());
         */
        return view('blog.index',  compact('posts'));
    }
    
    public function getShow(Post $post)
    {
       //$post=Post::published()->findOrFail($post);
        
       // to increment view acount by 1
       //$post->increment('view_count',1);
       $inc=$post->view_count+1;
       $post->update(['view_count'=>$inc]);
        
        return view('blog.show')->withPost($post);
    }
    
    public function getCategory(Category $category)
    {
        $categoryName=$category->title;

        /*$posts=Post::with('author')->published()->
                        latestFirst()->
                        where('category_id',$id)->
                        simplePaginate($this->limit);
       */
        $posts=  $category->posts()->   // Category $category, this meaning: Category::find($id)
                    with('author')->
                    published()->
                    latestFirst()->
                    simplePaginate($this->limit);
         
       
         
        return view('blog.index',  compact('posts','categoryName'));
    }
    
    public function getAuthor(User $author)
    {
        //\DB::enableQueryLog();
        $authorName=$author->name;
        $posts=$author->posts()
                    ->with('category')
                    ->published()
                    ->latestFirst()
                    ->simplePaginate($this->limit);

        
        return view('blog.index',compact('posts','authorName'));
       
       // dd(\DB::getQueryLog());
    }
    
    
    
}
