<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
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
        dd(ini_get('post_max_size'));
        return view('posts.create');         
    }

   public function store(Request $request)
   {
     $request->validate([
    'caption'=> 'required',
    'image' => 'required|image',
    'video' => 'required|mimes:mp4'
]);

$post = Post::create([
    'caption' => $request->input('caption'),
]);

if($request->file('image')) {
    $file_name = time().'_'.$request->file->getClientOriginalName();
    $file_path = $request->file('image')->storeAs('uploads', $file_name, 'public');

    $post->update([
        'image' => $file_name,
        'path' => $file_path
    ]);
}

if ($request->file('video')){
    $file_name = time().'_'.$request->video->getClientOriginalName(); 
    $file_path = $request->file('video')->storeAs('uploads', $file_name, 'public');

    $post->update([
        'video' => $file_name,
        'videoPath' => $file_path
    ]);
}

return response()->json(['success'=>'Files uploaded successfully.']);
}
 
 //    return redirect('/profile/'. auth()->user()->id );      
 // }

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
        $posts = Post::find($id);

        $posts->caption = $request->input('caption');

        if($request->has('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalName();
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $posts->image = $filename;
    }

    $posts->update();

    return redirect('/profile/'. auth()->user()->id );

    }
  
        public function delete($id)
        {
            $posts = Post::find($id);
            $posts->delete();
            return redirect('/profile/'. auth()->user()->id );
    
        }
        

}
