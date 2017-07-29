@extends('backend.layouts.master')
@section('content')
@section('title','Blog|Category')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Blog<small>Display all blog categories</small>
      </h1>
      <ol class="breadcrumb">
          <li ><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('blog.index')}}">Blog</a></li>
        <li class="active">All category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{route('backend.category.create')}}" class="btn btn-success">Add Category</a>
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
                            <th width='200'>Slug</th>
                            <th width='100'>Posts</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td >
                                
                                         
                                    <a href="{{route('backend.category.edit',$category->id)}}" class="btn btn-xs btn-default">
                                       <i class="fa fa-edit"></i>
                                    </a>
                                     {!! Form::open(["url"=>"/backend/category/$category->id","method"=>"delete","style"=>"display:inline-block;"]) !!}
                                        <button type="submit" onclick="return confirm('are sure delete category <?php echo $category->title ?>');" class=" btn btn-xs btn-danger">Delete</button>
                                     {!! Form::close() !!}
                                
                            </td> 
                                
                            <td>{{$category->title}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->posts->count()}}</td>
                           
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
                            
                        {{$categories->appends(Request::query())->render()}}
                    </div>        
                    <div class="pull-right">
                        <small> {{ $categoryCount}}  {{str_plural('Item',$categoryCount)}}</small>
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
