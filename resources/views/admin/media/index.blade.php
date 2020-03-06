@extends("layouts.admin")


@section("content")
<h2>Media Page</h2>

<div class="row">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            @if($medias)

                @foreach($medias as $media)
                    <tr>
                        <td>{{$media->id}}</td>
                        <td><img height="50" src="{{$media->file?$media->file:'/images/default.jpg'}}" alt=""></td>
                        <td>{{$media->created_at}}</td>
                        <td>
                            {!! Form::open(['method'=>'DELETE','action'=>['AdminMediaController@destroy',$media->id]]) !!}
                                {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach

            @endif
        </tbody>
    </table>
</div>

@endsection
