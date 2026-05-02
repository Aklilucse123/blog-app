<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    // Show all posts
    public function index(Request $request)
{
    $search = $request->input('search');

    $posts = \App\Models\Post::query()
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(6);

    return view('posts.index', compact('posts', 'search'));
}

    public function create()
    {
        return view('posts.create');
    }

    // Handle form submission
    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpg,Jpeg,png|max:2048',
    ]);

    $imagePath =null;
    if($request->hasfile('image')){
$imagePath=$request->file('image')->store('posts', 'public');

    }

    // Save to database
    Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'user_id' => auth()->id(),    
        'image' => $imagePath,
        ]);

    return redirect('/');

    }
    // show
    public function show(Post $post)
{
    return view('posts.show', compact('post'));
}
// edit

public function edit(Post $post)
{
    $this->authorize('update', $post);

    return view('posts.edit', compact('post'));
}

// update 
public function update(Request $request, Post $post)
{
        $this->authorize('update', $post);

    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);
    if ($request->hasfile('image')){

    $imagePath=$request->file('image')->store('post', 'public');
    $post->image =$imagePath;

    }

$post->title =$request->title;
$post ->content =$request->content;
$post ->save();

    return redirect('/');
}
// delete
public function destroy(Post $post)
{
        $this->authorize('delete', $post);

    $post->delete();

    return redirect('/');
}
}