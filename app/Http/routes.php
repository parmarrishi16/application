<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get("/post/{id}",['as'=>'home.post','uses'=>"AdminPostController@post"]);

Route::group(['middleware'=>'Admin'],function(){
    
 Route::resource("/admin/users","AdminUserController");
 Route::resource("/admin/posts","AdminPostController");
 Route::resource("/admin/categories","AdminCategoryController");
 Route::resource("/admin/media","AdminMediaController");
 
//  Route::get("/admin/medias/upload",['as'=>'admin.media.upload','uses'=>"AdminMediaController@upload"]);
Route::resource("/admin/comments",'PostCommentController');
Route::resource("/admin/comment/replies","CommentReplyController");

});
Route::get("/admin",function(){

    return view("admin.index");
});


Route::group(['middleware'=>'auth'],function(){

    Route::post("/comment/reply",'CommentReplyController@CreateReply');
    Route::get("/home/replies/{id}",['as'=>'home.replies','uses'=>'CommentReplyController@Replies']);
});