<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends BackendController
{
   
    public function index()
    {
        return view('backend.home');
    }
}
