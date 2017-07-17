@extends('layouts.master')

@section('content')

 <div class="row">
            <div class="col-md-8">
               @if(!$posts->count())
               <div class="alert alert-warning">Not found posts</div> 
               @else
                   @if(isset($categoryName))
                        <div class="alert alert-info">Category: <strong>{{$categoryName}}</strong></div> 
                   @endif
               @endif
               
               @if(isset($authorName))
                 <div class="alert alert-info">Author: <strong>{{$authorName}}</strong></div>
               @endif
               
               @foreach($posts as $post)
                @if ($post->image_url)
                            <div class="post-item-image">
                                <a href="post.html">
                                    <img src="{{ $post->image_url }}" alt="{{$post->title}}">
                                </a>
                            </div>
                        @endif
                    <div class="post-item-body">
                        <div class="padding-10">
                            <h2><a href="{{route('blog.show',$post->slug)}}">{{$post->title}}</a></h2>
                            <p>{!! $post->excerpt !!}</p>
                        </div>

                        <div class="post-meta padding-10 clearfix">
                            <div class="pull-left">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="{{route('blog.author',$post->author->slug)}}"> {{ $post->author->name}}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></li>
                                    <li><i class="fa fa-folder"></i><a href="{{route('blog.category',$post->category->slug)}}"> {{$post->category->title}}</a></li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                </ul>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('blog.show',$post->id)}}">Continue Reading &raquo;</a>
                            </div>
                        </div>
                    </div>
                </article>
           
               @endforeach 
                <nav>
                  {{$posts->links()}}
                </nav>
            </div>
            <div class="col-md-4">
              @include('includes.sidebar')
            </div>
        </div>

@endsection
   