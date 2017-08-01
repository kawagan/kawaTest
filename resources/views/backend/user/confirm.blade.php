@extends('backend.layouts.master')
@section('title','Confirm user')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         User<small>Add User</small>
      </h1>
      <ol class="breadcrumb">
          <li ><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/backend/user">users</a></li>
        <li class="active">Confirm user</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-9">
                <div class="box">
                    <div class="box-body">
                        {!! Form::open(["url"=>"backend/user/{$user->id}","method"=>"delete"]) !!}
                        <p>You have specified this user for deletion</p>
                        <p>id# {{$user->id}}: {{$user->name}} </p>
                        <p>What should be done with content own by this user</p>
                        
                        <div class="form-group">
                            <div class="radio">
                                <label >{!! Form::radio('delete') !!}Delete all content</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="radio">
                                <label >{!! Form::radio('attribute') !!}Attribute conntent to </label>
                                {!! Form::select('selectUser',$users,null) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Confirm Deletion</button>
                            <a href="/backend/user/" class="btn btn-default">Cancle</a>
                        </div>
                      {!! Form::close() !!}   
                    </div>
                </div>
            </div>
        </div><!-- ./row -->
           
        
      
    </section>
    
</div><!-- /.content -->
 @endsection
 