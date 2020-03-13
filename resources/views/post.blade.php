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
                <p class="lead">{!! $post->body !!}</p>

                <hr>
                <div id="disqus_thread"></div>
            <script>

            /**
            *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
            *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */
            (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://application-4.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
            })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            
                Blog Comments
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