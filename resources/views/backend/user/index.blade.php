@extends('backend.layouts.master')
@section('content')
@section('title','Blog|User')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Blog<small>Display all blog users</small>
      </h1>
      <ol class="breadcrumb">
          <li ><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('blog.index')}}">Blog</a></li>
        <li class="active">All users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="pull-left">
                        <a href="{{route('backend.user.create')}}" class="btn btn-success">Add User</a>
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
                            <th>Name</th>
                            <th width='200'>email</th>
                            <th width='200'>Roll</th>
                            <th width='100'>Posts</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td >        
                                <a href="{{route('backend.user.edit',$user->id)}}" class="btn btn-xs btn-default">
                                   <i class="fa fa-edit"></i>
                                </a>
                                @if($user->posts->count()>0 && $user->id != auth()->user()->id && $user->id!=config('blog_cms.admin_id') )
                                    <a href="{{route('user.confirm',$user->id)}}" class="btn btn-xs btn-danger">Delete</a> 
                                @else
                                    {!! Form::open(["url"=>"backend/user/$user->id","method"=>"delete","style"=>"display:inline-block"]) !!}
                                    {!! Form::hidden("noPosts",true)!!}
                                    {!! Form::submit('Delete',['class'=>'btn btn-xs btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </td> 
                                
                            <td>{{$user->name}} <span class="label label-primary">{{($user->id==$currentUser)?' current user':''}}</span></td>
                            <td>{{$user->email}}</td>
                            <td>-</td>
                            <td>{{$user->posts->count()}}</td>
                           
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
                            
                        {{$users->appends(Request::query())->render()}}
                    </div>        
                    <div class="pull-right">
                        <small> {{ $userCount}}  {{str_plural('Item',$userCount)}}</small>
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
