<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;

class CheckPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentMethodeName=$request->route()->getActionName();
        list($controller,$method)=  explode('@', $currentMethodeName);
        $controller=str_replace(['App\\Http\\Controllers\\backend\\','Controller'],'',$controller);
        $permissions=[
            'crud'=>['create','update','edit','store','destroy','update','restore','forceDelete']
        ];
        
        $className=[
            'Blog'=>'post',
            'Category'=>'category',
            'User'=>'user'
        ];
        
        
        $currenrUser=$request->user(); 
        foreach($permissions as $permission=>$methods){
            
            if(isset($className[$controller])){
                
                if(!$currenrUser->can("{$permission}-$className[$controller]")){
                   abort(403,'Forbidden access!'); 
                }
            
                if(in_array($method, $methods)){

                    if(($id=$request->route('blog')) && !($currenrUser->can(['update-others-post','delete-others-post'])) ){

                        $post=Post::findOrFail($id);
                        $otherId=$post->author_id;
                        if($otherId!=$currenrUser->id){
                            abort(403,'Forbidden access!'); 
                        }

                    }

                }
            }
            
            
        }    
        
        //dd($controller);
        
        return $next($request);
    }
}
