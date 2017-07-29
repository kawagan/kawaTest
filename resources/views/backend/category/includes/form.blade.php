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
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{$category->exists?'Update':'Save'}}</button>
                        <a href="/backend/category" class="btn btn-primary">Cancle</a>
                    </div>
                    
                </div>
                <!-- /.box-body -->
             
                
            </div>
            <!-- /.box -->
            
          </div>
            
         