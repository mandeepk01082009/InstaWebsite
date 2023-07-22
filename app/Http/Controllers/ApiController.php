<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Story;
use App\Models\Comment;
//use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    function getData()   
    {
        return["name"=>"anil","email"=>"anil@gmail.com","address"=>"delhi"];   
    }

    public function show()                 
    {
        $post = Post::all();
        return response()->json($post);    
        // return response()->json($post, 200);   
    }

    public function getUsers()
    {
        $user = User::all();
        return response()->json($user);      
    }

    public function getStory()
    {
        $story = Story::all();
        return response()->json($story);     
    }

    public function postComments(Request $request)  

    { 
            $comment = new Comment();
            $uniqid = rand(1000,5000);
            $comment->uniqid = $uniqid;
            $comment->comment_body = $request->comment_body;
            $comment->post_id = $request->post_id;
            $comment->user_id = $request->user_id;
            $comment->save();   
    
    
            $response = array(
                'status' => 'success',
                'msg' => 'Comment created successfully',
                'data' => $comment,
            );
            return Response::json($response);   
            return 'yes';

    } 

    public function update(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->comment_body = $request->comment_body;
        $comment->save();    

        $response = array(
            'status' => 'success',
            'msg' => 'Comment updated successfully',
            'data' => $comment,
        );

        return Response::json($response);   
        return 'yes';
    }

    public function search($name)
    {
        $result = Comment::where("comment_body","like","%".$name."%")->get();

        if(sizeof($result) == 0)
        {
            return "There are no match.";
        }
        else
        {
            return $result;  
        }
    }

    public function delete($id)
    {    
        $comment = Comment::find($id);
        $result = $comment->delete();  
        if($result)
        {
            return ["result"=>" Record has been deleted with id => ".$id];
        }
        else
        {
            return ["result"=>"Delete operation is failed"];
        }
       
    }

    public function testData(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'user_id' => 'required',
            'comment_body' => 'required',
        ]);
 
       
        if($validator->fails())
        {
            return response()->json($validator->errors(),401); 
        }
        else{
            $comment = new Comment();
            $uniqid = rand(1000,5000);
            $comment->uniqid = $uniqid;
            $comment->comment_body = $request->comment_body;                  
            $comment->post_id = $request->post_id;
            $comment->user_id = $request->user_id;                 
            $result = $comment->save();   

            if($result)
            {
                return ["Result" => "Data has been saved."];
            }
            else
            {
                return ["Result" => "Operation Failed"];    
            }
    
        }
       
    }

    // public function upload(Request $request)
    // {
    //     $result = $request->file('file')->store('apiFiles');                                     
    //     return ["result" => $result]; 
    //     return ["result" => "success"];         
    // }

    public function upload(Request $request)
   {
    $data = $request->validate([
    'caption'=> 'required',
    'image' => 'required',
    'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',      
    'video' => 'required|mimes:mp4',    
    'status' => 'nullable'      
]);

$post = Post::create([
    'caption' => $request->input('caption'),
    'user_id' => $request->user_id,
     'image' => '',
     'video' => '',   
     'status' => $request->status == true ? '1': '0',   
]);

// if($request->has('image')) {

//             $file = $request->file('image');
//             $extention = $file->getClientOriginalName();
//             $filename = time(). '.' . $extention;
//             $file->move('storage/',$filename);
//             $post->image = $filename;       
//     }

$fileNames = [];
foreach($request->file('image') as $image){
    $extention = $image->getClientOriginalName();
    $filename = time(). '.' . $extention;
    $image->move('storage/',$filename);
    $fileNames[] = $filename;
}
$post->image = json_encode($fileNames);
    
    if($request->has('video')) {
            $file = $request->file('video');
            $extention = $file->getClientOriginalName();   
            $filename = time(). '.' . $extention;
            $file->move('storage/',$filename);
            $post->video = $filename;             
    }

    $post->save();

return response()->json([
    "success" => true,
    "message" => "Post has been uploaded successfully."
]);
 }

 public function register(Request $request) 
 { 
     $validator = Validator::make($request->all(), [ 
         'name' => 'required',
         'email' => 'required|email|unique:users',
         'username' => 'required',
         'password' => 'required',
         'password_confirmation' => 'required|same:password',     
     ]);
     if ($validator->fails()) { 
          return response()->json(['error'=>$validator->errors()], 401);            
}
$input = $request->all(); 
     $input['password'] = bcrypt($input['password']); 
     $user = User::create($input); 
     $success['token'] =  $user->createToken('MyApp')->plainTextToken;             
     $success['name'] =  $user->name;

$response = [
    "success" => true,
    "data" => $success,
    "message" => "User register successfully."   
];

return Response::json($response,200);     

 }

 public function login(Request $request){
   
 if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
    $user = Auth::user();

    $success['token'] =  $user->createToken('MyApp')->plainTextToken;             
    $success['name'] =  $user->name;

$response = [
   "success" => true,
   "data" => $success,
   "message" => "User login successfully."   
];

return Response::json($response,200); 


 } else{
    $response = [
        "success" => false,
        "message" => "Unauthorised"   
     ];

    return response()->json($response);

    }

 }

 public function user(Request $request){

    $response = [
        "success" => true,
        "data" => $request->user(),
        "message" => "User successfully fetched."   
     ];
     
     return Response::json($response,200); 

 }

 public function logout(Request $request){   
    $request->user()->currentAccessToken()->delete();
    $response = [
        "success" => true,
        "message" => "User successfully logged out."      
     ];
     
     return Response::json($response,200);        


 }
 

}
