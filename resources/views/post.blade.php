@extends("layouts.blog-post");

@section("content")


                <!-- Blog Post -->

                <!-- Title -->
                @if(Session::has("comment_msg"))

                    {{Session('comment_msg')}}

                @endif
                <h1>{{$post->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$post->user->name}}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" height="250" width="900" src="{{$post->photo?$post->photo->file:'/images/default.jpg'}}" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">{{$post->body}}</p>

                <hr>

                <!-- Blog Comments -->
                @if(Auth::check())
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
    
                    {!! Form::open(['method'=>'post','action'=>'PostCommentController@store']) !!}

                        {!! Form::hidden('post_id',$post->id) !!}
                        <div class="form-group">
                            {!! Form::label('body','Body') !!}
                            {!! Form::textarea('body',null,['class'=>'form-control','rows'=>3])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                    
                </div>
                @endif

                <hr>
                 <!-- Nested Comment -->
                 @if(Session::has('reply_created'))
                                    <p class="alert alert-info">{{Session('reply_created')}}</p>
                @endif

                <!-- Posted Comments -->
                @if(count($comments)>0)
                <!-- Comment -->
                    @foreach($comments as $comment)
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" height="64" width="64" src="{{ $comment->file?$comment->file:'/images/default.jpg'}}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->author}}
                                <small>{{$comment->created_at->diffForHumans()}}</small>
                            </h4>
                            <p>{{$comment->body}}</p>
                            

                               

                                @if(count($comment->replies )>0)

                                    @foreach($comment->replies as $reply)
                                        @if($reply->is_active==1)
                                        <div class="media">
                                            <a class="pull-left" href="#">
                                                <img class="media-object" height="64" width="64"src="{{$reply->file?$reply->file:'/images/default.jpg'}}" alt="">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{$reply->author}}
                                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                                </h4>
                                                {{$reply->body}}
                                            </div>
                                        
                                        </div>
                                        @endif

                                        @endforeach
                                        
                                @endif
                                <br>
                                        <button class="btn btn-primary comment-reply">Reply</button>
                                        <div style="{display:none;}"class="toggle-reply-form">
                                            {!! Form::open(['method'=>'post','action'=>'CommentReplyController@CreateReply'])!!}
                                                <div class="form-group">
                                                    {!! Form::hidden('comment_id',$comment->id) !!}
                                                    {!! Form::label('body','Body') !!}
                                                    {!! Form::textarea('body',null,['class'=>'form-control','rows'=>1])!!}
                                                </div>
                                                {!! Form::submit('Reply',['class'=>'btn btn-primary']) !!}

                                            {!! Form::close() !!}
                                        </div>
                                <!-- End Nested Comment -->
                        </div>
                    </div>
                    @endforeach
                @endif
                

@endsection


@section("scripts")
<script>
    $(document).ready(function(){
        $(".toggle-reply-form").hide();
    })
    $(".comment-reply").click(function(){
       $(this).next().slideToggle("slow");
    });
</script>
@stop