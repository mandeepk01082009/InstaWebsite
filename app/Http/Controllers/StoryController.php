<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Story;  
use App\Models\Home;
use App\Models\StoryLikes; 
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
    


}
