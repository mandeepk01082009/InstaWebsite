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
        return view('posts.create'); 
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => 'required|image',

        ]);

        $imagePath = (request('image')->store('uploads', 'public'));

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(800, 800);
        $image->save();   

        

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);


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
