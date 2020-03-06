@extends("layouts.admin")

@section("content")

<h2>Categories Page</h2>
<div class="row">
    @if(Session::has('deleted'))
        <p class="alert alert-danger">{{Session('deleted')}}</p>
    @endif
</div>
<div class="row">
    <div class="col-sm-6">

        {!! Form::open(['method'=>'POSt','action'=>'AdminCategoryController@store']) !!}
            <div class="form-group">
                {!! Form::label('name','Name:') !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Create Category',['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-sm-6">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @if($categories)

                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td><a href="{{ route('admin.categories.edit',$category->id)}}">{{$category->name}}</a></td>
                            <td>{{$category->created_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach

                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="row col-sm-6">
    @include('includes.Form_errors');
</div>
@endsection