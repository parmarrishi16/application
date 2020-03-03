@extends("layouts.admin")


@section("content")

<h2>Create user</h2>
    {!! Form::open(['method'=>'POST','action'=>'AdminUserController@store'])!!}
    <div class="form-group">
        {!! Form::label('Name','Name') !!}
        {!! Form::text('name',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('Email','Email') !!}
        {!! Form::email('email',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('Role','Users Role :')!!}
        {!! Form::select('role_id',[0=>'Choose Roles']+$roles,null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('Status','Status :')!!}
        {!! Form::select('status',[1=>'Active',0=>'Not Active'],null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('password','Password :')!!}
        {!! Form::password('password',['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
    </div>

    {!! Form::close()!!}

    @include("includes.Form_errors")

    
@endsection