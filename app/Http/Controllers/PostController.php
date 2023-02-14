<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with('category')->get();
        return view('post.index', ['posts' => $posts]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('post.create', ['categories' => $categories]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|integer|exists:categories,id'
        ]);

        $post = Post::create($validated);

        return redirect()->route('post.edit', $post)->with('success', 'Пост создан');
    }

    public function edit(Post $post){
        $categories = Category::all();
        return view('post.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update(Post $post, Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|integer|exists:categories,id'
        ]);

        $post->update($validated);

        return redirect()->route('post.edit', $post)->with('success', 'Пост обновлен');
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Пост удален');
    }
}
