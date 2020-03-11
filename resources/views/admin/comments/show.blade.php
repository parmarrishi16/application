@extends("layouts.admin")


@section("content")

@if(Session::has('Deleted_cmt'))

<p class="alert alert-info">{{ Session('Deleted_cmt')}}</p>
@endif

@if(count($comments)>0)
<h2>Comments</h2>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Body</th>
        </tr>
    </thead>
    <tbody>
        @foreach($comments as $comment)
        <tr>
            <td>{{$comment->id}}</td>
            <td>{{$comment->author}}</td>
            <td>{{$comment->email}}</td>
            <td>{{$comment->body}}</td>
            <td><a href="{{ route('home.post',$comment->post_id)}}">View Post</a></td>
            <td>
                @if($comment->is_active===1)
                    {!! Form::open(['method'=>'PATCH','action'=>['PostCommentController@update',$comment->id]]) !!}

                        {!! Form::hidden('is_active',0) !!}
                        {!! Form::submit('Un-Approve',['class'=>'btn btn-success']) !!}

                    {!! Form::close() !!}
                @else
                    {!! Form::open(['method'=>'PATCH','action'=>['PostCommentController@update',$comment->id]]) !!}

                    {!! Form::hidden('is_active',1) !!}
                    {!! Form::submit('Approve',['class'=>'btn btn-info']) !!}

                    {!! Form::close() !!}
                @endif
            
            </td>

            <td>
                {!! Form::open(['method'=>'DELETE','action'=>['PostCommentController@destroy',$comment->id]]) !!}
                    {!! Form::submit('DELETE',['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@else

<h2 class="text-center">No Comments</h2>

@endif
@endsection
