@extends("layouts.admin")


@section("content")

<h2>Post Index page</h2>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo Id</th>
            <th>user Id</th>
            <th>Category Id</th>
            <th>Title</th>
            <th>body</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
    </thead>
    <tbody>
        
            @if($posts)
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td><img height="50"src="{{$post->photo?$post->photo->file:'/images/default.jpg'}}" alt=""></td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->category?$post->category->name:'No Category'}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach

            @endif
        
    </tbody>
</table>

@endsection