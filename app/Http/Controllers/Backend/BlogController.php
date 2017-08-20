<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Postrequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Auth;
use Intervention\Image\Facades\Image;

class BlogController extends BackendController
{
    protected $destination;
    
    public function __construct() {
        parent::__construct();
        $this->destination=  public_path(config('blog_cms.image.directory'));
    }
  
    public function index(Request $request)
    {
        $status=$request->get('status');
        
        if($status && $status=="trashed"){
            $posts=Post::onlyTrashed('author','category')->
                      latestFirst()->
                      paginate($this->limit);
            $postCount=$posts->count();
            
        }else if($status && $status=="published"){
            $posts=Post::withTrashed('author','category')->
                      latestFirst()->
                      published()->
                      paginate($this->limit);
            $postCount=$posts->count();
            
        }else if($status && $status=="schedule"){
            $posts=Post::withTrashed('author','category')->
                      latestFirst()->
                      schedule()->
                      paginate($this->limit);
            $postCount=$posts->count();
            
        }else if($status && $status=="draft"){
            $posts=Post::withTrashed('author','category')->
                      latestFirst()->
                      draft()->
                      paginate($this->limit); 
            $postCount=$posts->count();
           
        
         }else if($status && $status=="own"){
            $posts=Post::withTrashed('author','category')->
                      latestFirst()->
                      Own()->
                      paginate($this->limit); 
            $postCount=$posts->count();    
        }else{
            
            $posts=Post::withTrashed('author','category')->
                          latestFirst()->
                          paginate($this->limit);
            $postCount=$posts->count();
        }

        $statusList=$this->statusList($request);
        
        return view('backend.blog.index',compact('posts','statusList','postCount'));
    }

  
    public function create(Post $post)
    {
        //$post= new Post();
       return view('backend.blog.add_post',compact('post'));
    }

   /* public function store(Postrequest $request)
    {
      
         $dataFile=$this->uploadImage($request);
         //$request->user()->posts()->create($request->all());
          
         $authorId=Auth::user()->id;
         
         $post=new Post(); 
         $post->title=$request->input('title');
         $post->slug=$request->input('slug');
         $post->excerpt=$request->input('excerpt');
         $post->body=$request->input('body');
         $post->category_id=$request->input('category_id');
         $post->author_id=$authorId;
         $post->published_at=$request->input('published_at');
         $post->image=$dataFile;
         $post->save();

         session()->push('m','success');
         session()->push('m','The post has created successfully');

         return redirect('/backend/blog/');
 
    }*/
    
    public function store(Postrequest $request)
    {
        //Note::
        $data = $this->handleImage($request);

        $request->user()->posts()->create($data);
        
        session()->push('m','success');
        session()->push('m','The post has created successfully');

        return redirect('/backend/blog');
    }
    
    public function handleImage($request)
    {
      
      $data=$request->all();
      $fileName=NULL;
      if($request->hasFile('image')){
          $image=$request->file('image');
          $fileName=$image->getClientOriginalName();
          $result=$image->move($this->destination,$fileName);
          if($result){
            // intervention/image packagist
            $width= config('blog_cms.image.thumbnail.width');
            $height=config('blog_cms.image.thumbnail.height');
            $extension=$image->getClientOriginalExtension();
          $thumbnail=  str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
          Image::make($this->destination."/".$fileName)->
                     resize($width, $height)->
                     save($this->destination."/".$thumbnail);
          }
          $data['image']=$fileName;
      }
          
    return $data;  
    }

    public function show($id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        return view("backend.blog.edit_post",compact('post'));
    }

   
    public function update(Postrequest $request, $id)
    {
        $data=$this->handleImage($request);
        $post=Post::findOrFail($id);
        $oldImage=$post->image;
        $post->update($data);

        if($oldImage) $this->removeImage($oldImage);

        session()->push('m','success');
        session()->push('m','The post has updated successfully');
        return redirect('/backend/blog');
    }

    
    public function destroy($id)
    {
        $post=Post::findOrFail($id)->delete();
        
        session()->push('m','success');
        session()->push('m','The post has Trashed successfully');
        return redirect()->back();
    }
    
    public function deleteForEver($id)
    {
 
        $post=Post::onlyTrashed()->findOrFail($id);
        $post->forceDelete();
       
        $this->removeImage($post->image);
        
        //Note: after delete from Database the values is still saved in array $post
        
        session()->push('m','success');
        session()->push('m','The post has Trashed successfully');
        
        return redirect()->back();
    }
    
    public function restore($id)
    {
        
        $post=Post::onlyTrashed()->findOrFail($id)->restore();
        
        session()->push('m','success');
        session()->push('m','The post has restore successfully');
        return redirect()->back();

    }
    
    private function removeImage($image)
    {
        if(!empty($image)){
            $pathImage = $this->destination . "/" . $image;
            $ext = substr(strrchr($image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->destination . "/" . $thumbnail;

            if(file_exists($thumbnailPath))unlink ($thumbnailPath);
            if(file_exists($pathImage) )unlink ($pathImage);
        }
           
  
    }
    
    private function statusList($request)
    {
        return[
            'own'=>Post::withTrashed()->where('author_id',$request->user()->id)->count(),
            'all'=>Post::withTrashed()->count(),
            'published'=>Post::withTrashed()->published()->count(),
            'schedule'=>Post::withTrashed()->schedule()->count(),
            'draft'=>Post::withTrashed()->draft()->count(),
            'trashed'=>Post::onlyTrashed()->count()
            
        ];
    }
    
}
