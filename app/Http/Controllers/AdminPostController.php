<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PostCreaterequest;

use App\Http\Requests;
use App\Post;
use App\Photo;
use App\Category;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $posts=Post::all();
        return view("admin.posts.index",compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::pluck('name','id')->all();
        return view("admin.posts.create",compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        //
        $user=Auth::user();
        $input=$request->all();

        if($file=$request->file('photo_id'))
        {
            $name=time().$file->getClientOriginalName();

            $file->move("images",$name);

            $photo=Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;
        }

        $user->post()->create($input);

        return redirect("admin/posts");



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
        $post=Post::findBySlugOrFail($slug);
        $categories=Category::pluck('name','id')->all();
        return view("admin.posts.edit",compact('categories','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post=Post::findOrFail($id);

        $input=$request->all();

        if($file=$request->file('photo_id'))
        {
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $photo=Photo::create(['file'=>$name]);

            $input['photo_id']=$photo->id;
        }

         $post->update($input);

        return redirect("admin/posts");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::findOrFail($id);

        $name=$post->photo->file;
        unlink(public_path().$name);
        $post->photo->delete();
        $post->delete();

        return redirect("admin/posts");
    }



    public function post($slug)
    {
        $post=Post::findBySlugOrFail($slug);

         $comments=$post->comments->where('is_active',1);

         
        return view("post",compact("post","comments"));
    }
}
