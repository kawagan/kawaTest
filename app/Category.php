<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
   protected $fillable=['title','slug'];
   
   public function posts()
   {
       return $this->hasMany('App\Post'); 
   }
   
   // URL friendly
   public function getRouteKeyName() {
       return 'slug';
   }
}
