<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;         


class PostController extends Controller              
{
    public function __construct()     
    {
        $this->middleware('auth');           
    }    

    public function create()  
    {
        //dd(ini_get('post_max_size'));
        return view('posts.create');         
    }

   public function store(Request $request)
   {
    $data = $request->validate([
    'caption'=> 'required',
    'image' => 'required|image',
    'video' => 'required|mimes:mp4',
    'status' => 'nullable'
]);

$post = Post::create([
    'caption' => $request->input('caption'),
     'user_id' => auth()->id(),
     'image' => '',
     'video' => '',
     'status' => $request->status == true ? '1': '0',
]);

if($request->has('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalName();
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $post->image = $filename;       
    }

    $post->save();


if($request->has('video')) {
            $file = $request->file('video');
            $extention = $file->getClientOriginalName();
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $post->video = $filename;       
    }

    $post->save();

// return response()->json(['success'=>'Files uploaded successfully.']);
// }
 
    return redirect('/profile/'. auth()->user()->id );         
  }

    public function show(\App\Models\Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit($id)
        {
            $posts = Post::find($id);
            return view('posts.postupdate')->with('posts',$posts);

        }
    
    public function update(Request $request, $id)
    {
        $this->authorize('store', $request->post);
        $posts = Post::find($id);

        auth()->$posts->caption = $request->input('caption');

        if($request->has('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalName();
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $posts->image = $filename;       
    }

         if($request->has('video')) {
            $file = $request->file('video');
            $extention = $file->getClientOriginalName();
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $posts->image = $filename;       
    }

    auth()->$posts->update();

    return redirect('/profile/'. auth()->user()->id );

    }
  
        public function delete($id)
        {
            $posts = Post::find($id);
            $posts->delete();
            return redirect('/profile/'. auth()->user()->id );
    
        }
        

}
