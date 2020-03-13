<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
use App\User;
use App\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Web Routes one to many relations create new records
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get("/admin",function(){

    return view("admin.index");
});

Route::get('/logout', 'Auth\LoginController@logout');
Route::get("/admin",function(){

    return view("admin.index");
});


Route::group(['middleware'=>'Admin'],function(){
    
     Route::resource("/admin/users","AdminUserController",['names'=>[
         'index'=>'admin.users.index',
         'create'=>'admin.users.create',
         'store'=>'admin.users.store',
         'edit'=>'admin.users.edit',
     ]]);
     Route::resource("/admin/posts","AdminPostController",['names'=>[
        'index'=>'admin.posts.index',
         'create'=>'admin.posts.create',
         'store'=>'admin.posts.store',
         'edit'=>'admin.posts.edit',
     ]]);
     Route::resource("/admin/categories","AdminCategoryController",['names'=>[
        'index'=>'admin.categories.index',
         'create'=>'admin.categories.create',
         'store'=>'admin.categories.store',
         'edit'=>'admin.categories.edit',
     ]]);
     Route::resource("/admin/media","AdminMediaController",['names'=>[
        'index'=>'admin.media.index',
        'create'=>'admin.media.create',
        'store'=>'admin.media.store',
        'edit'=>'admin.media.edit',

     ]]);
     
    //  Route::get("/admin/medias/upload",['as'=>'admin.media.upload','uses'=>"AdminMediaController@upload"]);
    Route::resource("/admin/comments",'PostCommentController',['names'=>[
        'index'=>'admin.comments.index',
        'create'=>'admin.comments.create',
        'store'=>'admin.comments.store',
        'edit'=>'admin.comments.edit',
        'show'=>'admin.comments.show',
    ]]);
    Route::resource("/admin/comment/replies","CommentReplyController",['names'=>[
        'index'=>'admin.comments.replies.index',
        'create'=>'admin.comments.replies.create',
        'store'=>'admin.comments.replies.store',
        'edit'=>'admin.comments.replies.edit',

    ]]);
    
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get("/post/{id}",['as'=>'home.post','uses'=>"AdminPostController@post"]);

// Route::get("/admin",function(){

//     return view("admin.index");
// });


Route::group(['middleware'=>'auth'],function(){

    Route::post("/comment/reply",'CommentReplyController@CreateReply');
    Route::get("/home/replies/{id}",['as'=>'home.replies','uses'=>'CommentReplyController@Replies']);
});

Route::post("/admin/delete/media","AdminMediaController@deleteMedia");

// Route::get("/insert",function(){

//      $user=user::find(2);

//     $post=new App\Post(['Pname'=>'ajax post 2 for one to many relation']);

//     $user->post()->save($post);

// });


