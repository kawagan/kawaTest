<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermissionMiddleware
{
    
    
    public function handle($request, Closure $next)
    {
        // we have made "Helbers/permissions.php" and we put function"check_user_permissions" in it
        // to deactive edit and delete button for users and we move it function there
        // and then we have put "files":["App/Helpers/permissions.php"]  in composer.json
        // and we run the command: composer dump-autoload
        
        if( !check_user_permissions($request))
            abort(403,"Forbidden access!");
        
        
       return $next($request);  
    }
    
    /*
    public function handle($request, Closure $next)
    {
        // we have made "Helbers/permissions.php" and we put function"check_user_permissions" in it
        // to deactive edit and delete button for users and we move it function there
        
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
            
            // for example class "Home " not conatin to "$className"
            if(isset($className[$controller])){
                
                if(!$currenrUser->can("{$permission}-$className[$controller]")){
                   abort(403,'Forbidden access!'); 
                }
            
                if(in_array($method, $methods)){
                    
                    // get current id and we will see if he has permission in other user
                    if(($id=$request->route('blog')) && !($currenrUser->can(['update-others-post','delete-others-post'])) ){

                        $post=Post::findOrFail($id);
                        $otherId=$post->author_id;
                        if($otherId!=$currenrUser->id){
                            abort(403,'Forbidden access!'); 
                        }

                    }
                    
                    break;

                }
            }
            
            
        }    
        
        //dd($controller);
        
        return $next($request);
    }
     */
}
