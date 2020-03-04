@extends("layouts.admin")


@section("content")
<h2>Edit Users</h2>
<div class="col-sm-3">
    <img height="250" width="300" src="{{$user->photo?$user->photo->file:'/images/default.jpg'}}" alt="" class="img img-responsive img-rounded">
</div>
<div class="col-sm-9">
    {!! Form::model($user,['action'=>['AdminUserController@update',$user->id],'method'=>'PATCH','files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('name','Name')!!}
            {!! Form::text('name',null,['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('email','Email:')!!}
            {!! Form::email('email',null,['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!! Form::label('role_id','Role_id')!!}
            {!! Form::select('role_id',[1=>'No role']+$roles,null,['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::label('status','Status')!!}
            {!! Form::select('is_active',[1=>'active',0=>'Not active'],null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Photo','Photo')!!}
            {!! Form::file('file',['class'=>'form-control'])!!}
        </div>

        <div class="form-group">
            {!! Form::submit('submit',['class'=>'btn btn-primary','value'=>'Update'])!!}
        </div>
       

    {!! Form::close()!!}


    @include("includes.Form_errors")
</div>







@endsection