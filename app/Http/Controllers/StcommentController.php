<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Stcomment;   
use App\Models\User;   
use App\Models\Story;   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
//use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Str;  


class StcommentController extends Controller   
{
   
    public function postComments(Request $request)  

{ 
        $comment = new Stcomment();  
        $comment->comment_body = $request->comment_body;
        $comment->story_id = $request->story_id;   
        $comment->user()->associate($request->user());  
        $comment->save();


        $response = array(
            'status' => 'success',
            'msg' => 'Comment created successfully',
            'data' => $comment,
        );
        return Response::json($response);      
        return 'yes';   
   

        // if($comment->save()){           
        //     return response()->json(data:'Comment created successfully', status:'201');                             
        // }else{
        //     return response()->json(data:'fail', status:'400');                      
        // }
}

}
