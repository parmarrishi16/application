@extends("layouts.admin")


@section("content")

<h2>Create user</h2>
    {!! Form::open(['method'=>'POST','action'=>'AdminUserController@store','files'=>true])!!}
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
        {!! Form::select('role_id',[1=>'Choose Roles']+$roles,null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active','Is_active')!!}
        {!! Form::select('is_active',[1=>'active',0=>'Not active'],null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('file','Files')!!}
        {!! Form::file('file',['class'=>'form-control'])!!}
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