<?php

namespace App\Models;

use App\Models\User;
use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;
    protected $table = 'reactions';    
    protected $fillable = [
        'story_id','reaction','user_id',  
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
