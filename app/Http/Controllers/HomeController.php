<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Story;
use App\Models\StoryLikes;   
use App\Models\Profile;
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
    {       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $user = Auth::user();
        // $posts = Post::latest()->get();    
        //  return view('home',compact('user','posts'));  
        $posts = Post::whereIn('user_id', function($query)
        {       
            $query->select('follower_id')
                    ->from('followers')
                    ->where('following_id', Auth::user()->id);
        })->orWhere('user_id', Auth::user()->id)   
            ->with('user')
            ->orderBy('updated_at', 'DESC')->get();             

            $stories = Story::whereIn('user_id', function($query)
        {       
            $query->select('follower_id')
                    ->from('followers')
                    ->where('following_id', Auth::user()->id);
        })->orWhere('user_id', Auth::user()->id)
            ->with('user')
            ->orderBy('updated_at', 'DESC')->get();    
            
            //dd($user->story);  

    //    $stories = Story::orderBy('id','desc')->get();                                                              
       
    //    $stories = Story::whereBelongsTo($user)->orderBy('updated_at', 'DESC')->get(); 

        return view('home',compact('user','posts','stories'));                                      
    } 

//     public function getUserPortfolio($user) // fix it as $user only
// {
//     $userId = User::where('userName', $user)->first()->id; // I am expecting user id here like "1"
// }


     public function story(Request $request)   
     {
        $id = $request['id']; 
        $story = Story::where('user_id', $id)->get();   
      //  $story = Story::where('user_id', $id)->pluck('image'); 
       return response()->json(["story" => $story]);                                                      
    //     //return Response::json(['data' => 'data'], 200);          
                                        

     }

 
 }
