<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all()->sortByDesc('posted_at');

        return view('posts', [
            'posts' => $posts
        ]);
    }

    public function show(string $id)
    {
        $post = Post::find($id);

        return view('post', [
            'post' => $post
        ]);
    }

    public function category(string $category)
    {
        // Valid categories: rpg, game, web, code
        $posts = Post::where('category', $category)->get()->sortByDesc('posted_at');

        return view('posts', [
            'posts' => $posts,
            'category' => $category
        ]);
    }
}
