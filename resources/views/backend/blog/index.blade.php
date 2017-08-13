@extends('backend.layouts.master')
@section('content')
@section('title','Blog|Backend')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Blog<small>Display all blog posts</small>
      </h1>
      <ol class="breadcrumb">
          <li ><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('blog.index')}}">Blog</a></li>
        <li class="active">All post</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{route('backend.blog.create')}}" class="btn btn-success">Add Post</a>
                    </div>
                    
                    <div class="pull-right" style="padding-top: 10px;">
                        <?php $links=[]; ?>
                        @foreach($statusList as $key=>$value)
                            <?php $selected=(Request::get('status')==$key)?'selected':'';?>
                            <?php $links[]="<a href='?status=$key' class='$selected'>$key($value)</a>"; ?>
                        @endforeach
                        
                        {!! implode(' | ',$links) !!}
                        
              
                    </div>
                   
                    
                </div>
                 <!-- /.box-header -->
                <div class="box-body ">
                  
                     @if(Session::has('m'))
                    <?php $a=[]; $a=session()->pull('m');?>
                    <div class="alert alert-{{$a[0]}}">{{$a[1]}}</div>
                    @endif
                    <table class="table table-bordered">
                    <thead >
                        <tr >
                            <th width="100" >Action</th> 
                            <th>Title</th>
                            <th width='100'>Author</th>
                            <th width='160'>Category</th>
                            <th width='150'>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td width="{{$post->trashed()?'190':''}}">
                                
                                @if(!$post->trashed())
                                    
                                    <!-- check_user_permissions() is middleware-->
                                    <a href="{{route('backend.blog.edit',$post->id)}}" class="btn btn-xs btn-default {{!check_user_permissions(request(),$post->id)?'disabled':''}}" >
                                       <i class="fa fa-edit"></i>
                                    </a>
                                     {!! Form::open(["url"=>"/backend/blog/$post->id","method"=>"delete","style"=>"display:inline-block;"]) !!}
                                        <button type="submit" class=" btn btn-xs btn-danger {{!check_user_permissions(request(),$post->id)?'disabled':''}}">Delete</button>
                                     {!! Form::close() !!}
                                @else

                                    {!! Form::open(["route"=>['deleteForEver',$post->id],"method"=>"post","style"=>"display:inline-block;"]) !!}
                                    <button type="submit" onclick="return confirm('are you sure delete permenant');" class=" btn btn-xs btn-danger">Delete for ever</button>
                                    {!! Form::close() !!}


                                    {!! Form::open(["url"=>"/backend/blog/restore/{$post->id}","method"=>"post","style"=>"display:inline-block;"]) !!}
                                    <button type="submit" class=" btn btn-xs btn-info">Restore</button>
                                    {!! Form::close() !!}

                                   
                                
                                @endif
                            </td> 
                                
                            <td>{{$post->title}}</td>
                            <td>{{$post->author->name}}</td>
                            <td>{{$post->category->title}}</td>
                            <td>
                                <abbr title="{{$post->formularDate(true)}}">{{$post->formularDate()}}</abbr> | 
                                {!! $post->publicationLabel()  !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-left">
                        <!-- when i click link 'trashed' then pagination give me 'all'also
                         for that i add 'appends(Request::query()' to give me only trashed posts in all pagination -->
                            
                        {{$posts->appends(Request::query())->render()}}
                    </div>        
                    <div class="pull-right">
                        <?php 
                        //$postCount=$posts->count());// number of posts per page
                        $postCount=$postCount 
                        ?>
                        <small> {{ $postCount}}  {{str_plural('Item',$postCount)}}</small>
                    </div>
                    </nav>
                   
                </div>
                
            </div>
            <!-- /.box -->
            
          </div>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
 
 @section('script')
 <script language="javascript">
 $('ul.pagination').addClass('no-margin pagination-sm');
 </script>
 @endsection
