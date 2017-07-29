@extends('backend.layouts.master')
@section('title','Edit Category')
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Blog<small>Edit Category</small>
      </h1>
      <ol class="breadcrumb">
          <li ><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/backend/blog">Blog</a></li>
        <li class="active">Edit category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       {!! Form::model($category, [
                  'method' => 'PUT',
                  'route'  => ['backend.category.update', $category->id],
                  'files'  => TRUE,
                  'id' => 'post-form'
              ]) !!}
        <div class="row">
         
         @include('backend.category.includes.form')       
            </div>
        {!! Form::close() !!}    
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
 
 @section('script')
 @include('backend.category.includes.script_form')
 @endsection