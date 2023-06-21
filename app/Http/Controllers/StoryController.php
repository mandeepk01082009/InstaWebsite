<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Story;     

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
    'image' => 'required|image',
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

if($request->has('video')) {
            $file = $request->file('video');
            $extention = $file->getClientOriginalName();
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $story->video = $filename;         
    }

    $story->save();

// return response()->json(['success'=>'Files uploaded successfully.']);
// }
 
    return redirect('home');      
}

public function delete($id)
{
    $story = Story::find($id);
    $story->delete();
    return redirect('home');   

}
    


}
