@extends("layouts.admin")


@section("content")

<h2>Edit Category</h2>
<div class="row col-sm-7">
    {!! Form::model($category,['method'=>'PATCH','action'=>['AdminCategoryController@update',$category->id]]) !!}

        <div class="form-group">
            {!! Form::label('name','Name') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('update',['class'=>'btn btn-primary col-sm-3']) !!}
        </div>

    {!! Form::close() !!}
    {!! Form::open(['method'=>'DELETE','action'=>['AdminCategoryController@destroy',$category->id]]) !!}

        {!! Form::submit('Delete',['class'=>'btn btn-danger pull-right col-sm-3']) !!}

    {!! Form::close() !!}
</div>
<div class="row col-sm-7">
    @include('includes.Form_errors')
</div>
@endsection