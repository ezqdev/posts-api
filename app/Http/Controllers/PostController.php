<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API de Posts",
 *     version="1.0.0",
 *     description="API para gestionar posts"
 * )
 *
 * @OA\Schema(
 *     schema="Post",
 *     required={"id", "title", "content", "type"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Título del post"),
 *     @OA\Property(property="content", type="string", example="Contenido del post"),
 *     @OA\Property(property="type", type="string", enum={"Real estate events", "Classroom courses", "Webinars", "Legal updates", "News Mundoinmobilario.tv", "Promotions", "Publicity"}, example="Real estate events"),
 *     @OA\Property(property="image_url", type="string", example="https://ejemplo.com/imagen.jpg"),
 *     @OA\Property(property="active_from", type="string", format="date-time"),
 *     @OA\Property(property="active_to", type="string", format="date-time")
 * )
 */
class PostController
{
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     summary="Obtener lista de posts",
     *     tags={"Posts"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de posts obtenida con éxito",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Título del post"),
     *                 @OA\Property(property="content", type="string", example="Contenido del post"),
     *                 @OA\Property(property="image_url", type="string", example="https://ejemplo.com/imagen.jpg"),
     *                 @OA\Property(property="active_from", type="string", format="date-time"),
     *                 @OA\Property(property="active_to", type="string", format="date-time")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return Post::all();
    }

    /**
 * @OA\Post(
 *     path="/api/posts",
 *     summary="Crear un nuevo post",
 *     tags={"Posts"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title","content","type"},
 *             @OA\Property(property="title", type="string", example="Mi primer post"),
 *             @OA\Property(property="description", type="string", example="Mi primer descripcion para este post"),
 *             @OA\Property(property="content", type="string", example="Contenido del post"),
 *             @OA\Property(property="type", type="string", enum={"Real estate events", "Classroom courses", "Webinars", "Legal updates", "News Mundoinmobilario.tv", "Promotions", "Publicity"}, example="Real estate events"),
 *             @OA\Property(property="image_url", type="string", example="https://ejemplo.com/imagen.jpg"),
 *             @OA\Property(property="active_from", type="string", format="date-time", example="2024-10-21 10:00:00"),
 *             @OA\Property(property="active_to", type="string", format="date-time", example="2024-10-21 10:00:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Post creado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="¡El post se ha creado con éxito!"),
 *             @OA\Property(
 *                 property="post",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="Mi primer post"),
 *                 @OA\Property(property="desciption", type="string", example="Mi descripcion para este texto"),
 *                 @OA\Property(property="content", type="string", example="Contenido del post"),
 *                 @OA\Property(property="type", type="string", example="Real estate events"),
 *                 @OA\Property(property="image_url", type="string", example="https://ejemplo.com/imagen.jpg"),
 *                 @OA\Property(property="active_from", type="string", format="date-time"),
 *                 @OA\Property(property="active_to", type="string", format="date-time"),
 *                 @OA\Property(property="created_at", type="string", format="date-time"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Error de validación"
 *     )
 * )
 */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());

        return response()->json([
            'message' => '¡El post se ha creado con éxito!',
            'post' => $post
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     summary="Obtener un post específico",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Título del post"),
     *             @OA\Property(property="content", type="string", example="Contenido del post"),
     *             @OA\Property(property="image_url", type="string", example="https://ejemplo.com/imagen.jpg"),
     *             @OA\Property(property="active_from", type="string", format="date-time"),
     *             @OA\Property(property="active_to", type="string", format="date-time"),
     *             @OA\Property(property="created_at", type="string", format="date-time"),
     *             @OA\Property(property="updated_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="El post no existe")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'El post no existe'], 404);
        }

        return $post;
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     summary="Actualizar un post existente",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","content","type"},
        *             @OA\Property(property="title", type="string", example="Mi primer post"),
        *             @OA\Property(property="description", type="string", example="Mi primer descripcion para este post"),
        *             @OA\Property(property="content", type="string", example="Contenido del post"),
        *             @OA\Property(property="type", type="string", enum={"Real estate events", "Classroom courses", "Webinars", "Legal updates", "News Mundoinmobilario.tv", "Promotions", "Publicity"}, example="Real estate events"),
        *             @OA\Property(property="image_url", type="string", example="https://ejemplo.com/imagen.jpg"),
        *             @OA\Property(property="active_from", type="string", format="date-time", example="2024-10-21 10:00:00"),
        *             @OA\Property(property="active_to", type="string", format="date-time", example="2024-10-21 10:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post actualizado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="¡El post se ha actualizado con éxito!"),
     *             @OA\Property(
     *                 property="post",
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Título actualizado"),
     *                 @OA\Property(property="content", type="string", example="Contenido actualizado"),
     *                 @OA\Property(property="image_url", type="string", example="https://ejemplo.com/nueva-imagen.jpg"),
     *                 @OA\Property(property="active_from", type="string", format="date-time"),
     *                 @OA\Property(property="active_to", type="string", format="date-time"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post no encontrado"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->update($request->validated());

        return response()->json([
            'message' => '¡El post se ha actualizado con éxito!',
            'post' => $post
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     summary="Eliminar un post",
     *     tags={"Posts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del post",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Post eliminado exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="¡El post se ha eliminado con éxito!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Post no encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $post = Post::destroy($id);

        return response()->json([
            'message' => '¡El post se ha eliminado con éxito!',
        ]);
    }
}
