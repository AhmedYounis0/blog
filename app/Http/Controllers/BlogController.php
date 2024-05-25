<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check())
        {
            $blogs = Blog::where('user_id',Auth::user()->id)->get();
            return view('theme.blogs.index',compact('blogs'));
        }
        abort('403');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check())
        {
            $categories = Category::get();
            return view('theme.blogs.create',compact('categories'));
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();

        // 1 - get the image
        $image = $request->image;
        // 2 - change image name
        $imageNewName = uniqid() . $image->getClientOriginalName();
        // 3 - move image to my project
        $image->storeAs('blogs',$imageNewName,'public');
        // 4 - save record to database
        $data['image'] = $imageNewName;
        // set user name inside data
        $data['user_id'] = Auth::user()->id;
        Blog::create($data);
        return back()->with('BlogCreateSuccess','Your post has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('theme.single-blog',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if (Auth::user()->id == $blog->user_id){
            $categories = Category::get();
            return view('theme.blogs.edit',compact('categories','blog'));
        }
        abort('403');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if (Auth::user()->id == $blog->user_id) {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                // 0 - Delete old image
                Storage::delete("public/blogs/$blog->image");
                // 1 - get the image
                $image = $request->image;
                // 2 - change image name
                $imageNewName = uniqid() . $image->getClientOriginalName();
                // 3 - move image to my project
                $image->storeAs('blogs', $imageNewName, 'public');
                // 4 - save record to database
                $data['image'] = $imageNewName;
            }

            $blog->update($data);

            return back()->with('BlogUpdateSuccess', 'Your post has been updated successfully');
        }
        abort('403');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if (Auth::user()->id == $blog->user_id)
        {
            Storage::delete("public/blogs/$blog->image");
            $blog->delete();
            return back()->with('BlogDeleteSuccess', 'Your post has been deleted successfully');
        }
        abort('403');
    }
}
