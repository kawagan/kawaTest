<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{
    protected $fillable=['view_count'];
    //protected $dates=['published_at'];
    public function author()
    {
        return $this->belongsTo('App\User','author_id','id');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
   public function getTitleAttribute($value)
   {
       return ucfirst($value);
   }
   
   public function getDateAttribute($value)
   {
       if(!is_null($this->published_at)){
           $pub=Carbon::parse($this->published_at);
           return $pub->diffForHumans();
       }else{
           return '';
       }   
            
   }
   
   public function setPublishedAtAttribute($value)
   {
       $this->attributes['published_at'] = $value ?: NULL;
   }
    public function getImageUrlAttribute($value)
    {
       if ( ! is_null($this->image) ){
           $imagePath="";
           $imageURl= public_path().'/img/'.$this->image;
           if(file_exists($imageURl)){
               $imagePath=  asset('img/'.$this->image);
           }
           return $imagePath;
       }
       
    }
    
    public function getImageThumbUrlAttribute($value)
    {
        $imageUrl = "";

        if ( ! is_null($this->image))
        {
            $ext       = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = public_path() . "/img/" . $thumbnail;
            if (file_exists($imagePath)) $imageUrl = asset("img/" . $thumbnail);
        }

        return $imageUrl;
    }
    
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at','desc');
    }
    
    public function scopePopular($query)
    {
        return $query->orderBy('view_count','desc');
    }
    public function scopePublished($query)
    {
        return $query->where('published_at','<=',Carbon::now());
    }
    
    public function formularDate($value=false)
    {
        $date='d/m/Y';
        if($value){
          $date.=' H:i:s';
        }
        return $this->created_at->format($date);
    }
    
    public function publicationLabel()
    {
        $cdate=Carbon::now();
        if(!$this->published_at){
            $x='<span class="label label-warning"><small>Draft<small></span>';
        }elseif($this->published_at && $this->published_at>$cdate ){
            $x='<span class="label label-info"><small>Schedule</small></span>';
        }else{
            $x='<span class="label label-success"><small>Published</small></span>';
        }
        return $x;
    }
    
    public function textg(){
        ;
    }
    
}
