@extends("layouts.admin")


@section("content")
<h2>Media Page</h2>

<div class="row">
    <form action="/admin/delete/media" method="post" class="form-inline">
    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    <select name="checkBoxArr"  class="form-control">
        <option value="">Delete</option>
    </select>
    <input type="submit" value="Submit" name="delete_all" class="btn btn-primary">

    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input type="checkbox"  id="options" ></th>
                <th>Id</th>
                <th>Name</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            @if($medias)

                @foreach($medias as $media)
                    <tr>
                        <td><input type="checkbox" name="checkBoxArr[]" class="checkboxes" value="{{$media->id}}"></td>
                        <td>{{$media->id}}</td>
                        <td><img height="50" src="{{$media->file?$media->file:'/images/default.jpg'}}" alt=""></td>
                        <td>{{$media->created_at}}</td>
                        <td>
                                <input type="hidden" name="photo" value="{{$media->id}}">
                               <div class="form-group">
                                    <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
                               </div>
                            
                        </td>
                    </tr>
                @endforeach

            @endif
        </tbody>
    </table>
    </form>
</div>

@endsection

@section("scripts")
    <script>
    $("#options").click(function(){
        
        if(this.checked)
        {
            $(".checkboxes").each(function(){
                this.checked=true;
            })
        }
        else
        {
            $(".checkboxes").each(function(){
                this.checked=false;
            })
        }
    })
    </script>

@stop