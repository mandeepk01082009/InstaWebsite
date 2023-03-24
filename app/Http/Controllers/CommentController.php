<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::check())
        {
            $validator = Validator::make($request->all(),[
            ]);
            $post = Post::where('slug', $request->post_slug)->where('status','0')->first();
            if($post)
            {
                Comment::create([
                    'post_id' => $post->id,
                    //'user_id' => auth()->user()->id(),
                    'user_id' => Auth::user()->id,
                    'comment_body' => $request->comment_body
                ]);
            }
            else
            {
                redirect()->back()->with('message','No such Post Found');
            }

        }
        else
        {
            redirect()->back()->with('message','Login first to comment');
        }
    }
}
