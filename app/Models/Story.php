<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
       
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'stories';
    protected $fillable = ['user_id','image','video']; 
    
    public function storyLike()
    {
        return $this->hasMany(StoryLikes::class, 'story_id', 'id');    
    }

    public function reaction()
    {
        return $this->hasMany(Reaction::class, 'story_id', 'id');
    }  

}
