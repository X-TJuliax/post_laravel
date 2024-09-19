<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
       
        $posts = Post::all();
        // error_log($posts);

        return $posts;
     
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        return Post::create($request->all());
    }

    public function show($id)
    {
        // return Post::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return $post;
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return response()->noContent();
    }
}
