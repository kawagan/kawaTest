<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
     protected $limit=5;
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-permission');
    }

}
