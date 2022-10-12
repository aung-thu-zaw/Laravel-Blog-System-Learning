<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Validation\Rule;

class AdminBlogController extends Controller
{
    public function index()
    {
        return view("admin.blogs.index", [
            "blogs"=>Blog::latest()->paginate(6)
        ]);
    }
    public function create()
    {
        return view("admin.blogs.create", [
            "categories"=>Category::all()
        ]);
    }

    public function store()
    {
        // $path=request()->file("thumbnail")->store("thumbnails");

        $blogFormData=request()->validate([
            "title"=>["required"],
            "slug"=>["required",Rule::unique("blogs", "slug")],
            "intro"=>["required"],
            "body"=>["required"],
            "category_id"=>["required",Rule::exists("categories", "id")],
        ]);
        $blogFormData["user_id"]=auth()->id();

        $blogFormData["thumbnail"]=request()->file("thumbnail")->store("thumbnails");

        Blog::create($blogFormData);

        return back();
    }

    public function edit(Blog $blog)
    {
        return view("admin.blogs.edit", [
            "blog"=>$blog,
            "categories"=>Category::all()
        ]);
    }

    public function update(Blog $blog)
    {
        $blogFormData=request()->validate([
            "title"=>["required"],
            "slug"=>["required",Rule::unique("blogs", "slug")->ignore($blog->id)],
            "intro"=>["required"],
            "body"=>["required"],
            "category_id"=>["required",Rule::exists("categories", "id")],
        ]);
        $blogFormData["user_id"]=auth()->id();

        $blogFormData["thumbnail"]=request()->file("thumbnail") ? request()->file("thumbnail")->store("thumbnails") : $blog->thumbnail;


        $blog->update($blogFormData);
        return redirect("/");
    }

    public function destory(Blog $blog)
    {
        $blog->delete();
        return back();
    }
}
