<?php

namespace App\Http\Controllers;

use App\Mail\SubscriberMail;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Blog $blog)
    {
        request()->validate([
         "comment"=>"required",
        ]);




        $blog->comments()->create([
            "user_id"=>auth()->user()->id,
            "commentText"=>request("comment")
        ]);

        // Mail
        $subscribers=$blog->subscribers->filter(fn ($subscriber) =>$subscriber->id != auth()->id());

        $subscribers->each(function ($subscriber) use ($blog) {
            Mail::to($subscriber->email)->queue(new SubscriberMail($blog));
        });



        return redirect("/blogs/".$blog->slug);
        // return redirect()->back();
        // return back();
    }
}
