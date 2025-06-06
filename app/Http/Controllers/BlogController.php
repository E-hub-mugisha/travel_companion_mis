<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the blogs.
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('panel.blogs.index', compact('blogs'));
    }

    /**
     * Store a newly created blog.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'content'       => 'required|string',
            'author'        => 'required|string|max:100',
            'category'      => 'nullable|string|max:100',
            'tags'          => 'nullable|string',
            'published_at'  => 'nullable|date',
            'is_published'  => 'required|boolean',
        ]);

        Blog::create([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'content'       => $request->content,
            'author'        => $request->author,
            'category'      => $request->category,
            'tags'          => $request->tags,
            'is_published'  => $request->is_published,
            'published_at'  => $request->published_at,
            'image'         => null, // You can add image upload logic later
        ]);

        return redirect()->back()->with('success', 'Blog created successfully.');
    }

    /**
     * Update the specified blog.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title'         => 'required|string|max:255',
            'content'       => 'required|string',
            'author'        => 'required|string|max:100',
            'category'      => 'nullable|string|max:100',
            'tags'          => 'nullable|string',
            'published_at'  => 'nullable|date',
            'is_published'  => 'required|boolean',
        ]);

        $blog->update([
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'content'       => $request->content,
            'author'        => $request->author,
            'category'      => $request->category,
            'tags'          => $request->tags,
            'is_published'  => $request->is_published,
            'published_at'  => $request->published_at,
        ]);

        return redirect()->back()->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified blog.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->back()->with('success', 'Blog deleted successfully.');
    }
}
