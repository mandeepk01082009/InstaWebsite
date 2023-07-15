<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryLikes extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id','like','story_id',
    ];

    public function user()   
     {
      return $this->belongsTO(User::class, 'user_id','id');                       
     }

    public function story()        
     {
      return $this->belongsTO(Story::class, 'story_id','id');              
     }
}
