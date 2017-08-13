<?php

function check_user_permissions($request,$idPost=null)
{ 
    
   // this is middleware for users , we put this function in Middleware/CheckPermissionMiddleware
   // and we put it also in construct function in Backend/BackendController for upload automaticly 
    $currentMethodeName=$request->route()->getActionName();
        list($controller,$method)=  explode('@', $currentMethodeName);
        $controller=str_replace(['App\\Http\\Controllers\\backend\\','Controller'],'',$controller);
        $permissions=[
            'crud'=>['index','create','update','edit','store','destroy','restore','forceDelete','view','show','deleteForEver']
        ];
        
        $className=[
            'Blog'=>'post',
            'Category'=>'category',
            'User'=>'user',
            'blog'=>'post'
        ];
        
        
        $currenrUser=$request->user(); 
        foreach($permissions as $permission=>$methods){
 
            // for example class "Home " not conatin to "$className"
            if(isset($className[$controller]) && in_array($method, $methods)){
                
                if(!$currenrUser->can("{$permission}-$className[$controller]")){
                   return false; 
                }
                
                !empty($idPost)?$id=$idPost:$id=$request->route('blog');
                // get current id and we will see if he has permission in other user
                if(($id) && !($currenrUser->can(['update-others-post','delete-others-post'])) ){

                    $post=\App\Post::withTrashed()->findOrFail($id);
                    $otherId=$post->author_id;
                    if($otherId!=$currenrUser->id){
                        return false; 
                    }
                }

                break;
            }
   
        }    
return true;
}
