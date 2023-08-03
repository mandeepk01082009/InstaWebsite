<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use Cviebrock\Database\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;  

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable():array
    {
        return[
            'slug' =>[
                'source' => 'caption'
            ]
        ];
    }

    protected $table = 'posts';
    protected $fillable = ['user_id','caption','image','video','status'];  

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

     public function like()
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }

}
