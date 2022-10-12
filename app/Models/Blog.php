<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $with=["category","author"];
    // protected $guarded=[];
    // protected $fillable=["blogSlug","blogTitle","blogIntro","blogBody"];


    public function scopeFilter($query, $filter)
    {
        // Normal if else condition Syntax
        // if (request("searchblog")) {
        //     $query=$query->where(
        //         function ($query) {
        //             $query
        //             ->where("blogTitle", "LIKE", "%".request("searchblog")."%")
        //             ->orwhere("blogIntro", "LIKE", "%".request("searchblog")."%");
        //         }
        //     );
        // }



        // OOP Syntax
        $query=$query->when(
            $filter["searchblog"]??null,
            function ($query, $searchblog) {
                $query->where(
                    function ($query) use ($searchblog) {
                        $query
                        ->where("blogTitle", "LIKE", "%".$searchblog."%")
                        ->orWhere("blogIntro", "LIKE", "%".$searchblog."%");
                    }
                );
            }
        );

        // Search By CategorySlug
        $query=$query->when(
            $filter["category"]??null,
            function ($query, $slug) {
                $query->whereHas(
                    "category",
                    function ($query) use ($slug) {
                        $query
                            ->where("slug", $slug);
                    }
                );
            }
        );

        // Search By Author Username
        $query=$query->when(
            $filter["username"]??null,
            function ($query, $username) {
                $query->whereHas(
                    "author",
                    function ($query) use ($username) {
                        $query
                            ->where("username", $username);
                    }
                );
            }
        );
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function subscribers()
    {
        return $this->belongsToMany(User::class);
        // return $this->belongsToMany(User::class, "blog_user");
    }


    public function unSubscribe()
    {
        // $this->subscribers()->detach([1,2,3,4,5]);
        $this->subscribers()->detach(auth()->id());
    }
    public function subscribe()
    {
        $this->subscribers()->attach(auth()->id());
    }
}
