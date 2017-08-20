       <div class="col-xs-9">
            <div class="box">
               
                <div class="box-body ">
                    <!-- //when we add new column in form and database should be add it in 'protected $fillable'in class user -->
                    <div class="form-group {{$errors->has('name')?'has-error':''}}">
                    {!! Form::label('name','Name')!!}
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                    @if($errors->has('name'))
                    <span class="help-block">{{$errors->first('name')}}</span>
                    @endif
                    </div>
                    
                    <div class="form-group {{$errors->has('slug')?'has-error':''}}">
                    {!! Form::label('slug','Slug')!!}
                    {!! Form::text('slug',null,['class'=>'form-control']) !!}
                    @if($errors->has('slug'))
                    <span class="help-block">{{$errors->first('slug')}}</span>
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
                    
                   
                    <div class="form-group {{$errors->has('role')?'has-error':''}}">
                    {!! Form::label('role','Role')!!}
                    @if($user->exists && $user->id==config('blog_cms.admin_id') || isset($editAccount) && ($editAccount=='true' ) )<!--$editAccount in file:backend/home/edit_account, for update info without Role-->
                    {!! Form::hidden('role',$user->roles->first()->id) !!}
                    <div class="form-control-static">{{$user->roles->first()->display_name}}</div>
                    @else
                    {!! Form::select('role',App\Role::pluck('display_name','id'),$user->exists?$user->roles->first()->id:'null',['class'=>'form-control','placeholder'=>'select role']) !!}
                    
                    @if($errors->has('role'))
                    <span class="help-block">{{$errors->first('role')}}</span>
                    @endif
                    
                    @endif
                    </div>
                    
                    <div class="form-group">
                    {!! Form::label('bio','Bio')!!}
                    {!! Form::textarea('bio',null,['rows'=>5,'class'=>'form-control']) !!}
                   
                    </div>
                    
                   
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">{{$user->exists?'Update':'Save'}}</button>
                        <a href="{{request()->route()->back}}" class="btn btn-primary">Cancle</a>
                    </div>
                    
                </div>
                <!-- /.box-body -->
             
                
            </div>
            <!-- /.box -->
            
          </div>
            
         