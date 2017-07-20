@extends('backend.layouts.master')
@section('title','Add Post')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Blog<small>Add Post</small>
      </h1>
      <ol class="breadcrumb">
          <li ><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('blog.index')}}">Blog</a></li>
        <li class="active">Add post</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open(["url"=>"backend/blog","id"=>"post-form","files"=>"true"]) !!}
        <div class="row">
         
         @include('backend.includes.form')       
            </div>
        {!! Form::close() !!}    
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
 
 @section('script')
 @include('backend.includes.script_form')
 @endsection