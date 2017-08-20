@extends('backend.layouts.master')
@section('title','Edit Account')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Blog<small>Edit Account</small>
      </h1>
      <ol class="breadcrumb">
          <li ><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/backend/blog">Blog</a></li>
        <li class="active">Edit Account</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       {!! Form::model($user, [
                  'method' => 'PUT',
                  'url'  => ['/update-account'] 
              ]) !!}
        <div class="row">
         <!--$editAccount in file:backend/home/edit_account, for update info without Role-->
         @include('backend.user.includes.form',['editAccount'=>'true'])       
            </div>
        {!! Form::close() !!}    
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
 