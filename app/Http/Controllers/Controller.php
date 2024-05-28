<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function store(StorePostRequest $request)
    {
        return Post::create($request->validated());
    }

    public function show($id)
    {
        return Post::findOrFail($id);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->validated());
        return $post;
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return response()->noContent();
    }
}
