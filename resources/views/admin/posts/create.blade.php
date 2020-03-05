@extends("layouts.admin")


@section("content")
<h2 class="text-center">Create Post</h2>

    <div class="row">
        {!! Form::open(['method'=>'POST','action'=>'AdminPostController@store','files'=>true])!!}

            <div class="form-group">
                {!! Form::label('title','Title')!!}
                {!! Form::text('title',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id','category Id :')!!}
                {!! Form::select('category_id',[0=>'No category']+$categories,null,['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id','Photo :')!!}
                {!! Form::file('photo_id',['class'=>'form-control'])!!}
            </div>

            <div class="form-group">
                {!! Form::label('body','Description')!!}
                {!! Form::textarea('body',null,['class'=>'form-control','rows'=>3]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Create Post',['class'=>'btn btn-primary'])!!}
            </div>

        {!! Form::close()!!}
    </div>

    <div class="row">
        @include("includes.Form_errors")
    </div>

@endsection