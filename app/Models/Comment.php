<?php

namespace App\Models;

use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

     protected $table = 'comments';
     protected $fillable = [
        'post_id',
        'user_id',
        'comment_body'
     ];

     public function post()
     {
      return $this->belongsTO(Post::class, 'post_id','id');
     }

     public function user()
     {
      return $this->belongsTO(User::class, 'user_id','id');
     }
}
