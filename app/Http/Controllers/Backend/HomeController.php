<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;

class HomeController extends BackendController
{
   
    public function index()
    {
        return view('backend.home.index');
    }
    
    public function edit(Request $request)
    {
        $user=$request->user();
       return view('backend.home.edit_account',  compact('user')); 
    }
    
    public function update(Requests\UserUpdateAccountRequest $request)
    {
      $user=$request->user();
      $user->update($request->all());
      return redirect('/home');
    }
}
