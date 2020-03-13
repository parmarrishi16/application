<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;

class AdminMediaController extends Controller
{
    //
    public function index()
    {
        $medias=Photo::all();
        return view("admin.media.index",compact('medias'));
    }
 

    public function create()
    {
        return view("admin.media.upload");
    }

    public function store(Request $request)
    {
        $file=$request->file('file');

        $name=time().$file->getClientOriginalName();

        $file->move('images',$name);

        Photo::create(['file'=>$name]);
    }

    public function destroy($id)
    {
        $photo=Photo::findOrFail($id);

        unlink(public_path().$photo->file);

        $photo->delete();

        
    }

    public function deleteMedia(Request $request)
    {
        if(isset($request->delete_single))
        {
            $this->destroy($request->photo);
            return redirect('/admin/media');
        }
        else if(isset($request->delete_all) && !empty($request->checkBoxArr))
        {
            $photos=Photo::findOrFail($request->checkBoxArr);
            
            foreach($photos as $photo)
            {
                $photo->delete();
            }
            return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }

        



    }
}
