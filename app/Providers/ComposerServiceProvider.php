<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use Carbon\Carbon;
use App\Post;
use App\Views\Composers\NavigationComposer;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
     // we can write code tow method: 
     // 1- write here as one function
     // 2- in seperate class in Views/Composers/NavigationComposer.php
     // this code auto load, and i register it on config/app.php
       view()->composer('includes.sidebar',NavigationComposer::class);
       
       
       // this code auto load, and i register it on config/app.php
       // view()->composer('includes.sidebar',function($view){
          /*  
            $categories=  Category::with(['posts'=>function($query){
                  $query->where('published_at','<=',Carbon::now());
            }])->orderBy('title','desc')->get();*/
        //or
       /*     
        $categories=  Category::with(['posts'=>function($query){
            $query->published();}
        ])->orderBy('title','desc')->get();
        return $view->with('categories',$categories);
        });
        
        view()->composer('includes.sidebar',function($view){
           $popularPosts=Post::published()->popular()->take(3)->get();
           return $view->with('popularPosts',$popularPosts);
        });*/
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
