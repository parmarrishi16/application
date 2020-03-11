<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Reply;
use App\Comment;

use App\Http\Requests;

class CommentReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "it workds";
    }

    public function Replies($id)
    {
         $comment=Comment::findOrFail($id);
         $replies=$comment->replies;

         return view("admin.comments.replies.show",compact('replies'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "its works";
    }

    public function CreateReply(Request $request)
    {
        $user=Auth::user();

        $data=[
            'comment_id' =>$request->comment_id,
            'author'     =>$user->name,
            'file'       =>$user->photo->file,
            'email'      =>$user->email,
            'body'       =>$request->body,

        ];
        
        Reply::create($data);
        Session::flash("reply_created","You replied to comment successfully");
        return redirect()->back();
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
    public function edit($id)
    {
        //
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
        $reply=Reply::findOrFail($id);

        $reply->update($request->all());

        return redirect()->back();
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
        $reply=Reply::findOrFail($id);

        $reply->delete();

        Session::flash("reply_deleted","your reply has been deleted");
        return redirect()->back();
    }
}
