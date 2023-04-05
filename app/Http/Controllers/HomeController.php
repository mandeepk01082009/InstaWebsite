<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Intervention\Image\Facades\Image;  
use Illuminate\Support\Facades\Storage; 


class HomeController extends Controller  
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {  
        return view('home', compact('user'));    
        
    }

    public function likePost(Request $request)
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

}
