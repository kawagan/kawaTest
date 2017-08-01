<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
class UserController extends BackendController
{
  
    public function index()
    {
        $users= User::with(['posts'=>function($query){
            $query->withTrashed();
        }])->orderBy('created_at','desc')->paginate($this->limit);
        
        $userCount=User::count();
        
        $currentUser=auth()->user()->id;

        return  view('backend.user.index',compact('users','userCount','currentUser'));
    }
   
    public function create(User $user)
    {
        //$user=new User();
        return view('backend.user.add_user',compact('user'));
    }

   
    public function store(Requests\UserStoreRequest $request)
    {
        /* we have to way to make crypt password:
         -$request['password']=  bcrypt($request->input('password'));
         - i have made "setPasswordAttribute function" in class User
         */
        User::create($request->all());
      
        session()->push('m','success');
        session()->push('m','The user has created successfully');
        
        return redirect('/backend/user');
    }

 
    public function edit($id)
    {
        $user=User::findOrFail($id);
        return view('backend.user.edit_user',compact('user'));
    }

  
    public function update(Requests\UserUpdateRequest $request, $id)
    {

        if(!empty($request->input('password'))){
            $request['password']=  bcrypt($request->input('password'));
            User::findOrFail($id)->update($request->all());
        }else{
            User::findOrFail($id)->update($request->except('password'));
        }
        
        
        session()->push('m','success');
        session()->push('m','The user has updated successfully');
        
        return redirect()->route('backend.user.index');
    }

   
    public function destroy(Requests\UserDeleteRequest $request,$id)
    {
        if(!empty($request->input('noPosts') && $request->input('noPosts')==true )){
            User::where('id',$id)->delete();
            
            session()->push('m','success');
            session()->push('m','The user deleted successfully');
            
        }else if($request->input('delete')=='delete'){
            Post::withTrashed()->where('author_id',$id)->forceDelete();
            
            session()->push('m','success');
            session()->push('m','The user and all contetns have deleted successfully');
            
            User::where('id',$id)->delete();
            
        }else if($request->input('attribute')=='attribute'){
            
            Post::withTrashed()->where('author_id',$id)
                               ->update(['author_id'=>$request->input('selectUser')]);
            
            $newUser=User::findOrFail($request->input("selectUser")); 
            $newUser=$newUser->name;
            
            session()->push('m','success');
            session()->push('m','The user has deleted successfully and all thier contents moved to user: '.$newUser);
            
            User::where('id',$id)->delete();
        }

        
        
        
        return redirect('/backend/user'); 
    }
    
    public function confirm($id)
    {
        $currrentUser=auth()->user()->id; // or Auth::user()->id
        $user=User::findOrFail($id);
        $users=User::whereNotIn('id',[$currrentUser,$id])->pluck('name','id');
        return view('backend.user.confirm',compact('user','users'));
    }
    
}
