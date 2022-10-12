<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    public function index()
    {
        // @dd($this->authorize("admin"));
        // @dd(auth()->user()->can("admin"));
        // @dd(Gate::allows("admin"));
        // $this->authorize("admin");
        return view('blogs.index', [
            // Blog::latest()->where("blogTitle", request("searchBlog"))->get();
          "blogs"=>Blog::latest()->filter(request(["searchblog","category","username"]))->paginate(6)->withQueryString(), //"blogs"=>Blog::with()->get()
        ]);
    }

    public function show(Blog $blog)
    {
        return view("blogs.show", [
            "blog"=>$blog,
            "randomBlogs"=>Blog::inRandomOrder()->take(3)->get()
        ]);
    }
    public function subscriptionHandler(Blog $blog)
    {
        // if (auth()->user()->isSubscribed($blog)) {
        if (User::find(auth()->id())->isSubscribed($blog)) {
            $blog->unSubscribe();
            return back();
        } else {
            $blog->subscribe();
            return back();
        }
    }
}
