@extends("layouts.admin")


@section("content")

@if(Session::has('reply_deleted'))

<p class="alert alert-info">{{ Session('reply_deleted')}}</p>
@endif

@if(count($replies)>0)
<h2>Replies</h2>

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
        @foreach($replies as $reply)
        <tr>
            <td>{{$reply->id}}</td>
            <td>{{$reply->author}}</td>
            <td>{{$reply->email}}</td>
            <td>{{$reply->body}}</td>
            
            <td>
                @if($reply->is_active===1)
                    {!! Form::open(['method'=>'PATCH','action'=>['CommentReplyController@update',$reply->id]]) !!}

                        {!! Form::hidden('is_active',0) !!}
                        {!! Form::submit('Un-Approve',['class'=>'btn btn-success']) !!}

                    {!! Form::close() !!}
                @else
                    {!! Form::open(['method'=>'PATCH','action'=>['CommentReplyController@update',$reply->id]]) !!}

                    {!! Form::hidden('is_active',1) !!}
                    {!! Form::submit('Approve',['class'=>'btn btn-info']) !!}

                    {!! Form::close() !!}
                @endif
            
            </td>

            <td>
                {!! Form::open(['method'=>'DELETE','action'=>['CommentReplyController@destroy',$reply->id]]) !!}
                    {!! Form::submit('DELETE',['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@else

<h2 class="text-center">No Replies</h2>

@endif
@endsection
