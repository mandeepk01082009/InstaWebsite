<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable implements JWTSubject 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',   
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function($user){
            $user->profile()->create([
                'title' => $user->username,
            ]);  
        });
    }

  
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');

    }

    public function story()
    {
        return $this->hasMany(Story::class)->orderBy('created_at','DESC');  

    }

     public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function stcomments()
    {
        return $this->hasMany('App\Models\Stcomment');        
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'user_id', 'id');   
    }

    public function reaction()     
    {
        return $this->hasMany(Reaction::class, 'user_id', 'id');                  
    }

    public function storyLike()
    {
        return $this->hasMany('App\Models\StoryLikes');    
    }

    //  public function like()
    // {
    //     return $this->hasMany('App\Models\Like');
    // }

    public function followings(){
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');   
    }

    public function followers(){
        return $this->belongsToMany(User::class, 'followers', 'follower_id','following_id');          
    }
    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()  
    {
        return [];  
    }

    
}
