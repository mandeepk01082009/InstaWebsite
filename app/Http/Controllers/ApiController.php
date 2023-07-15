<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Story;
use App\Models\Comment;
//use Validator;
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
            'post_id' => 'required|min:2|max:4',
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

    public function upload(Request $request)
    {
        $result = $request->file('file')->store('apiDocs');                                   
        return ["result" => $result];       
    }
}
