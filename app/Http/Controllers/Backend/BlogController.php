<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Postrequest;
use App\Http\Requests\Request;
use App\Post;
use Auth;
use Intervention\Image\Facades\Image;

class BlogController extends BackendController
{
    protected $limit=8;
    protected $destination;
    
    public function __construct() {
        parent::__construct();
        $this->destination=  public_path(config('blog_cms.image.directory'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::withTrashed('author','category')->
                      latestFirst()->
                      paginate($this->limit);
        return view('backend.blog.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
          $thumbnail=  str_replace(".{$extension}", "_thum.{$extension}", $fileName);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Postrequest $request, $id)
    {
        $data=$this->handleImage($request);
        $post=Post::findOrFail($id);
        $post->update($data);
        
        session()->push('m','success');
        session()->push('m','The post has updated successfully');
        return redirect('/backend/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::findOrFail($id)->delete();
        
        session()->push('m','success');
        session()->push('m','The post has Trashed successfully');
        return redirect()->back();
    }
    
    public function deleteForEver($id)
    {
        $post=Post::onlyTrashed()->findOrFail($id)->forceDelete();
        
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
    
}
