@extends('backend.layouts.master')
@section('title','Edit User')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Blog<small>Edit User</small>
      </h1>
      <ol class="breadcrumb">
          <li ><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/backend/blog">Blog</a></li>
        <li class="active">Edit user</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       {!! Form::model($user, [
                  'method' => 'PUT',
                  'route'  => ['backend.user.update', $user->id]
              ]) !!}
        <div class="row">
         
         @include('backend.user.includes.form')       
            </div>
        {!! Form::close() !!}    
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
 