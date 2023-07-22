<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryLikes extends Model
{
    use HasFactory;

    protected $table = 'storylikes';
    
    protected $fillable = [
        'user_id','story_id','like'  
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
