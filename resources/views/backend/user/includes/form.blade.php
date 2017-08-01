       <div class="col-xs-9">
            <div class="box">
               
                <div class="box-body ">
                    
                    <div class="form-group {{$errors->has('name')?'has-error':''}}">
                    {!! Form::label('name','Name')!!}
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                    @if($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                    @endif
                    </div>
                    
                    <div class="form-group {{$errors->has('email')?'has-error':''}}">
                    {!! Form::label('email','Email')!!}
                    {!! Form::text('email',null,['class'=>'form-control']) !!}
                    @if($errors->has('email'))
                    <span class="help-block">{{$errors->first('email')}}</span>
                    @endif
                    </div>
                    
                    <div class="form-group {{$errors->has('password')?'has-error':''}}">
                    {!! Form::label('password','Password')!!}
                    {!! Form::password('password',['class'=>'form-control']) !!}
                    @if($errors->has('password'))
                    <span class="help-block">{{$errors->first('password')}}</span>
                    @endif
                    </div>
                    
                    <div class="form-group {{$errors->has('password_confirmation')?'has-error':''}}">
                    {!! Form::label('password_confirmation','Confirm password')!!}
                    {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
                    @if($errors->has('password_confirmation'))
                    <span class="help-block">{{$errors->first('password_confirmation')}}</span>
                    @endif
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{$user->exists?'Update':'Save'}}</button>
                        <a href="/backend/user" class="btn btn-primary">Cancle</a>
                    </div>
                    
                </div>
                <!-- /.box-body -->
             
                
            </div>
            <!-- /.box -->
            
          </div>
            
         