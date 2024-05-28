<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController
{
    public function index()
    {
        return Post::all();
    }

    public function store(StorePostRequest $request) // Usa StorePostRequest en lugar de Request
    {
        return Post::create($request->validated());
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
            'content' => 'required|string|max:4294967295',
            'image_url' => 'nullable|string',
            'type' => 'required|in:Blog,News,Event,Update',
            'active_from' => 'required|date',
            'active_to' => 'required|date',
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
