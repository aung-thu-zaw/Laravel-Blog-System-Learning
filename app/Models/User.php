<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

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

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function getuserNameAttribute($value)
    {
        return strtolower($value);
    }
    public function setuserNameAttribute($value)
    {
        return $this->attributes["username"]=strtolower($value);
    }
    public function setpasswordAttribute($value)
    {
        return $this->attributes["password"]=bcrypt($value);
    }
    public function subscribedBlogs()
    {
        return $this->belongsToMany(Blog::class);
        // return $this->belongsToMany(Blog::class,"blog_user");
    }

    public function isSubscribed($blog)
    {
        return auth()->user()->subscribedBlogs &&
         auth()->user()->subscribedBlogs->contains("id", $blog->id);
    }
}
