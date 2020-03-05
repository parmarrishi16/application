@extends("layouts.admin")


@section("content")
<h2 class="text-center">Edit Post</h2>

    <div class="row">
        <div class="col-sm-3">
            <img src="{{$post->photo?$post->photo->file:'/images/default.jpg'}}" alt="" class="img-responsive">
        </div>
        <div class="col-sm-9">
            {!! Form::model($post,['method'=>'PATCH','action'=>['AdminPostController@update',$post->id],'files'=>true])!!}

                <div class="form-group">
                    {!! Form::label('title','Title')!!}
                    {!! Form::text('title',null,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('category_id','category Id :')!!}
                    {!! Form::select('category_id',[0=>'No category 1']+$categories,null,['class'=>'form-control'])!!}
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
                    {!! Form::submit('Update Post',['class'=>'btn btn-primary col-sm-3'])!!}
                </div>

            {!! Form::close()!!}

            {!! Form::open(['method'=>'DELETE','action'=>['AdminPostController@destroy',$post->id]]) !!}
                {!! Form::submit('Delete',['class'=>'btn btn-danger col-sm-3 pull-right']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        @include("includes.Form_errors")
    </div>

@endsection