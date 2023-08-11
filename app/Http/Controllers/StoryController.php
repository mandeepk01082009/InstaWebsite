<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Story;  
use App\Models\Home;
use App\Models\StoryLikes; 
use App\Models\Reaction; 
use Illuminate\Support\Facades\DB;
use Auth;    


use Illuminate\Http\Request;

class StoryController extends Controller     
{
    public function create()  
    {
        return view('story.create');         
    }

    public function store(Request $request)  
   {
    $data = $request->validate([
    'image' => 'required',
   // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',   
    'video' => 'required|mimes:mp4,mov,ogg | max:20000' 
]);

$story = Story::create([
     'user_id' => auth()->id(),
     'image' => '',
     'video' => '',   
]);


if($request->has('image')) {

            $file = $request->file('image');
            $extention = $file->getClientOriginalName();
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $story->image = $filename;       
    }

// $fileNames = [];
// foreach($request->file('image') as $image){
//     $extention = $image->getClientOriginalName();
//     $filename = time(). '.' . $extention;
//     $image->move('storage/',$filename);    
//     $fileNames[] = $filename;
// }
// $story->image = json_encode($fileNames);    

if($request->has('video')) {
            $file = $request->file('video');
            $extention = $file->getClientOriginalName();            
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);             
            $story->video = $filename;             
    }

    $story->save();

// return response()->json(['success'=>'Files uploaded successfully.']);      

 
    return redirect('home');      
}

public function delete($id)
{
    $story = Story::find($id);
    $story->delete();
    return redirect('home');             

}

public function storyLike(Request $request)   
        {
            $story_id = $request['storyId'];
            $is_like = $request['isLike'] === 'true';  
            $update = false;  
            $story = Story::find($story_id);   
            if (!$story){
                return null;         
            }
            $user = Auth::user();
            $like = $user->storyLike()->where('story_id', $story_id)->first();   
            if($like){
                $already_like = $like->like;
                $update = true;     
                if ($already_like == $is_like){
                    $like->delete();     
                    return null;        
                }
            }else {
                $like = new StoryLikes();
            }
            $like->like = $is_like;
            $like->user_id = $user->id;
            $like->story_id = $story->id;
            if ($update) {
                $like->update();                 
            } else {
                $like->save();   
                
            }
            return null;   
        }

    public function react(Request $request)       
    { 
        $story_id = $request['story_id'];  
        $user_id = $request['user_id'];  
        $react = $request['react'];        
        DB::table('reactions')->insert(array("story_id"=>$story_id,"user_id"=>$user_id,"reaction"=>$react)); 
        return response()->json(['success'=>'true']);         
    }
     // $data = array("story_id"=>$story_id,"user_id"=>$user_id,"react"=>$react);
        // DB::table('reactions')->insert($data);  

    //dd($react); 
        //$quert=DB::insert('insert into reactions (story_id,user_id,react)',[$story_id,$user_id,$react]);  
        //$statement = "INSERT INTO reations('story_id','user_id','react' ) VALUES ('".$story_id."', '".$user_id."', ".$react.");";
        // if ($request->ajax()) {           
        //     $result = Reaction::insert($request->all());       
    
        //     if ($result) {
        //         return response()->json(['success'=>'true']);
        //     } else {
        //         return response()->json(['success'=>'false']);
        //     }            
        // }        
    //     $react = new Reaction();  
    //     $react->story_id = $request->story_id;  
    //     $react->user()->associate($request->user());      
    //     $react->save();     


    //     $response = array(
    //         'status' => 'success',
    //         'msg' => 'React on story successfully',  
    //         'data' => $react,
    //     );
    //     return Response::json($response);   
    //     return 'yes';   
    // }

    // $input = Request::all();
    // $user = Auth::user();
    // $user->first_name = $input->first_name;
    // $user->save();
    // return response()->json(['user_saved' => $user ]);

    }    
   
                                    
    



