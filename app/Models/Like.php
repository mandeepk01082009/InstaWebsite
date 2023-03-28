<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','like','post_id',
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
