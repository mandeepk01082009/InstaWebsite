<?php

namespace App\Models;

use App\Models\Story;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stcomment extends Model
{
    use HasFactory;
    protected $table = 'stcomments';
     protected $fillable = [
        'story_id',
        'user_id',
        'comment_body'
     ];

     public function story()   
     {
      return $this->belongsTO(Story::class, 'story_id','id');                                     
     }              

     public function user()
     {
      return $this->belongsTO(User::class, 'user_id','id');
     }
}
