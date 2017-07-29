@extends('backend.layouts.master')
@section('title','Edit Post')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Blog<small>Edit Post</small>
      </h1>
      <ol class="breadcrumb">
          <li ><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/backend/blog">Blog</a></li>
        <li class="active">Edit post</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       {!! Form::model($post, [
                  'method' => 'PUT',
                  'route'  => ['backend.blog.update', $post->id],
                  'files'  => TRUE,
                  'id' => 'post-form'
              ]) !!}
        <div class="row">
         
         @include('backend.blog.includes.form')       
            </div>
        {!! Form::close() !!}    
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
 
 @section('script')
 @include('backend.blog.includes.script_form')
 @endsection