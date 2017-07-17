@extends('layouts.master')

@section('content')
 <div class="row">
            <div class="col-md-8">
                <article class="post-item post-detail">
                    @if($post->image_url)
                    <div class="post-item-image">
                        <a href="#">
                            <img src="{{$post->image_url}}" alt="{{$post->title}}">
                        </a>
                    </div>
                    @endif

                    <div class="post-item-body">
                        <div class="padding-10">
                            <h1>{{$post->title}}</h1>

                            <div class="post-meta no-border">
                                <ul class="post-meta-group">
                                    <li><i class="fa fa-user"></i><a href="{{route('blog.author',$post->author->slug)}}"> {{$post->author->name}}</a></li>
                                    <li><i class="fa fa-clock-o"></i><time> {{$post->date}}</time></li>
                                    <li><i class="fa fa-folder"></i><a href="{{route('blog.category',$post->category->slug)}}"> {{$post->category->title}}</a></li>
                                    <li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li>
                                </ul>
                            </div>

                            {!!$post->body!!}
                            <!--  {!! Markdown::convertToHtml($post->body) !!}-->
                        </div>
                    </div>
                </article>

                <article class="post-author padding-10">
                    <div class="media">
                      <div class="media-left">
                        <a href="{{route('blog.author',$post->author->slug)}}">
                            <img alt="{{$post->author->name}}" width="100" height="100" src="{{$post->author->gavatar()}}" class="media-object">
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading"><a href="{{route('blog.author',$post->author->slug)}}">{{$post->author->name}}</a></h4>
                        <div class="post-author-count">
                          <a href="{{route('blog.author',$post->author->slug)}}">
                              <i class="fa fa-clone"></i>
                              <?php $postCount = $post->author->posts()->published()->count(); ?>
                              {{ $postCount }} {{ str_plural('post', $postCount) }}
                          </a>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad aut sunt cum, mollitia excepturi neque sint magnam minus aliquam, voluptatem, labore quis praesentium eum quae dolorum temporibus consequuntur! Non.</p>
                      </div>
                    </div>
                </article>

                <!-- Comments is here -->
            </div>
            <div class="col-md-4">
              @include('includes.sidebar')
            </div>
        </div>
@endsection
