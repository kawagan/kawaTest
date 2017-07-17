@extends('backend.layouts.master')
@section('content')
@section('title','Add Post')
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
            <div class="col-xs-9">
            <div class="box">
               
                <div class="box-body ">
                    
                    <div class="form-group {{$errors->has('title')?'has-error':''}}">
                    {!! Form::label('title','Title')!!}
                    {!! Form::text('title',null,['class'=>'form-control']) !!}
                    @if($errors->has('title'))
                    <span class="help-block">{{$errors->first('title')}}</span>
                    @endif
                    </div>
                    
                    
                    <div class="form-group {{$errors->has('slug')?'has-error':''}}">
                    {!! Form::label('slug','Slug')!!}
                    {!! Form::text('slug',null,['class'=>'form-control']) !!}
                    @if($errors->has('slug'))
                    <span class="help-block">{{$errors->first('slug')}}</span>
                    @endif
                    </div>
                    
                    <div class="form-group {{$errors->has('excerpt')?'has-error':''}}">
                    {!! Form::label('excerpt','Excerpt')!!}
                    {!! Form::textarea('excerpt',null,['class'=>'form-control']) !!}
                    @if($errors->has('excerpt'))
                    <span class="help-block">{{$errors->first('excerpt')}}</span>
                    @endif
                    </div>
                    
                    <div class="form-group {{$errors->has('body')?'has-error':''}}">
                    {!! Form::label('body','Body')!!}
                    {!! Form::textarea('body',null,['class'=>'form-control']) !!}
                    @if($errors->has('body'))
                    <span class="help-block">{{$errors->first('body')}}</span>
                    @endif
                    </div>

                    
                </div>
                <!-- /.box-body -->
             
                
            </div>
            <!-- /.box -->
            
          </div>
            
            <div class="col-xs-3">
                <div class="box">
                    <div class="box-header with-border ">
                        <h3 class="box-title">Publish</h3> 
                    </div>
                    <div class="box-body ">
                        
                        <div class="form-group {{$errors->has('published_at')?'has-error':''}}">
                            {!! Form::label('published_at','Publish date')!!}
                            <div class='input-group date' id='datetimepicker1'>
                                {!! Form::text('published_at',null,['class'=>'form-control','placeholder'=>'Y-m-d H:i:s']) !!}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                           </div>
                        
                           @if($errors->has('published_at'))
                           <span class="help-block">{{$errors->first('published_at')}}</span>
                           @endif
                        </div>
                        <div class="box-footer clearfix no-pad-left no-pad-right">
                            <div class="pull-left ">
                                <a id="btn-draft" class="btn btn-default">Save Draft</a>
                            </div>
                            <div class="pull-right ">
                                {!! Form::submit('Publish',['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <div class="box">
                    <div class="box-header with-border ">
                        <h3 class="box-title">Category</h3> 
                    </div>
                    <div class="box-body ">
                        <div class="form-group {{$errors->has('category_id')?'has-error':''}}">
                            {!! Form::select('category_id',App\category::pluck('title','id'),null,['class'=>'form-control','placeholder'=>'choose category']) !!}
                            @if($errors->has('category_id'))
                            <span class="help-block">{{$errors->first('category_id')}}</span>
                            @endif
                       </div>
                    </div>   
                    
                </div>
                <div class="box">
                    <div class="box-header with-border ">
                        <h3 class="box-title">feature Image</h3> 
                    </div>
                    <div class="box-body ">
                          <div class="form-group {{$errors->has('image')?'has-error':''}}">                      
                   
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://via.placeholder.com/200x150">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                            <div class="text-center">
                                <span class="btn btn-default btn-file  "><span class="fileinput-new ">Select image</span><span class="fileinput-exists">Change</span>{!! Form::file('image')!!}</span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    @if($errors->has('image'))
                        <span class="help-block">{{$errors->first('image')}}</span>
                     @endif
                    </div>
                    </div>   
                    
                </div>
            </div>
                
                
            </div>
        {!! Form::close() !!}    
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
 @endsection
 
 @section('script')
 <script language="javascript">
 $('ul.pagination').addClass('no-margin pagination-sm');
 $("#title").on('blur',function(){
      var str=this.value.toLowerCase().trim();
      var replace=str.replace(/^&|&$/g,'')
                     .replace(/&/g,'-and-')
                     .replace(/[^a-z0-9-]+/g,'-')
                     .replace(/^-+|-+$/g,'')
                     .replace(/\-\-+/g,'-');                  
    $("#slug").val(replace);
 });
 
 $(function () {
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        showClear: true
    });
 });
 
 $("#btn-draft").click(function(e){
     e.preventDefault();
     $("#published_at").val("");
     $("#post-form").submit();
 });
 </script>
 @endsection
