<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;   

class CommentController extends Controller
{
    public function postComments(Request $request)
{
    if($request->ajax()){
        $comment = new Comment();
        $comment->comment_body = $request->comment_body;
        $comment->post_id = $request->post_id;
        $comment->user()->associate($request->user());

        $comment->save();


        $response = array(
            'status' => 'success',
            'msg' => 'Comment created successfully',
            'data' => $comment,
        );
        return Response::json($response);   
        return 'yes';
    }else{
        return 'no';   
    }
}

    // public function store(Request $request)
    // {
    //     if(Auth::check())  
    //     {
    //         $validator = Validator::make($request->all(),[
    //             'comment_body' => 'required|string'
    //         ]);

    //         if ($validator->fails()) {
    //             return redirect()->back()->with('message', 'Comment area is mandatory');     
    //         }

    //         $post = Post::where('slug', $request->post_slug)->first();
    //         if($post)
    //         {
    //             Comment::create([   
    //                 'post_id' => $post->id,
    //                 //'user_id' => auth()->user()->id(),
    //                 'user_id' => Auth::user()->id,
    //                 'comment_body' => $request->comment_body
    //             ]);
    //             return redirect()->back()->with('message','Commented Succsfully');
    //         }
    //         else
    //         {
    //            return redirect()->back()->with('message','No such Post Found');
    //         }

    //     }
    //     else
    //     {
    //        return redirect()->back()->with('message','Login first to comment');
    //     }
    // }    

    public function destroy(Request $request)
    {
        if (Auth::check()) {
            $comment = Comment::where('id',$request->comment_id)->where('user_id',Auth::user()->id)->first();

            if($comment)
            {
                $comment->delete();
                return response()->json([   
                'status' => 200,
                'message' => 'Comment Deleted Successfully'

            ]);

            }
            else
            {
                return response()->json([   
                'status' => 500,
                'message' => 'Something went Wrong'

            ]);
            }

            
        }
        else
        {
            return response()->json([
                'status' => 401,
                'message' => 'Login to Delete this content'

            ]);
        }
    }
    // public function destroy($id)
    //     {
    //         $comment = Comment::find($id);
    //         $comment->delete();
    //         return redirect()->back()->with('message','Comment Deleted Successfully');
    
    //     }
}
