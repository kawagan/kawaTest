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
                            <th width='70'>Action</th>
                            <th>Title</th>
                            <th width='100'>Author</th>
                            <th width='160'>Category</th>
                            <th width='150'>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>
                                <a href="{{route('backend.blog.edit',$post->id)}}" class="btn btn-xs btn-default">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{route('backend.blog.destroy',$post->id)}}" class="btn btn-xs btn-danger">
                                    <i class="fa fa-times"></i>
                                </a>
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
                            {{$posts->render()}}
                    </div>        
                    <div class="pull-right">
                        <?php $postCount=$post->count() ?>
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
