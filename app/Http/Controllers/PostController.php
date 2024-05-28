<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController
{
    public function index()
    {
        return Post::all();
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());

        return response()->json([
            'message' => '¡El post se ha creado con éxito!',
            'post' => $post
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'El post no existe'], 404);
        }

        return $post;
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->update($request->validated());

        return response()->json([
            'message' => '¡El post se ha actualizado con éxito!',
            'post' => $post
        ]);
    }


    public function destroy($id)
    {
        $post = Post::destroy($id);

        return response()->json([
            'message' => '¡El post se ha eliminado con éxito!',
        ]);
    }
}
