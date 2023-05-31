<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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

    /*if($request->has("image")){
        //dd($request->hasFile("image"));
        $files->$request->file("image");
        foreach ($files as $file) {
            $extention = $file->getClientOriginalName();
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $fileNames[] = $filename;
            $post->image = $filename; 
            dd($fileNames);
        }
    }
    $post->save();*/

if($request->has('image')) {

            $file = $request->file('image');
            $extention = $file->getClientOriginalName();
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $post->image = $filename;       
    }  
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
        $posts = Post::find($id);

        $posts->caption = $request->input('caption');

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
            $posts->video = $filename;       
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

        public function postLike(Request $request)
        {
            $post_id = $request['postId'];
            $is_like = $request['isLike'] === 'true';
            $update = false;  
            $post = Post::find($post_id);   
            if (!$post){
                return null;         
            }
            $user = Auth::user();
            $like = $user->like()->where('post_id', $post_id)->first();   
            if($like){
                $already_like = $like->like;
                $update = true;
                if ($already_like == $is_like){
                    $like->delete();     
                    return null;    
                }
            }else {
                $like = new Like();
            }
            $like->like = $is_like;
            $like->user_id = $user->id;
            $like->post_id = $post->id;
            if ($update) {
                $like->update();   
            } else {
                $like->save();
            }
            return null;   
        }

        public function follow($following_id){
            $following = User::find($following_id);
            if(auth()->user()->followings->contains($following_id)){
                auth()->user()->followings()->detach($following);
            }
            else
            {
                auth()->user()->followings()->attach($following);
            }
            return redirect()->back();
            
        }

} 


        
