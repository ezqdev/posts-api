<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|longText',
            'cover_image_url' => 'string',
            'type' => 'required|in:Blog,News,Event,Update',
            'active_from' => 'required|date',
            'active_to' => 'required|date'
        ]);

        return Post::create($request->all());
    }

    public function show($id)
    {
        return Post::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|longText',
            'cover_image_url' => 'string',
            'type' => 'required|in:Blog,News,Event,Update',
            'active_from' => 'required|date',
            'active_to' => 'required|date'
        ]);

        $post->update($request->all());

        return $post;
    }

    public function destroy($id)
    {
        Post::destroy($id);

        return response()->noContent();
    }
}
