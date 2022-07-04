<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\PostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostCollection;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description",
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      },
 *      @OA\Contact(
 *          email="julio.yanez@codigoxules.org"
 *      ),
 *      @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/posts",
     *     tags={"posts"},
     *     summary="Mostrar el listado de posts",
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todas los posts."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function index()
    {
        $posts = $this->postRepository->getAll();

        return new PostCollection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/api/posts",
     *     tags={"posts"},
     *     summary="Crear un posts",
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="userId",
     *                     oneOf={
     *                         @OA\Schema(type="string"),
     *                         @OA\Schema(type="integer"),
     *                     },
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     maxLength=255,
     *                 ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="string",
     *                 ),
     *
     *                 example={"userId": "10", "title": "Una piedra en el camino", "body": "Esto debería ser una historia..."}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Creado el posts."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function store(PostRequest $request)
    {
        $post = $this->postRepository->create( $request->all() );

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     tags={"posts"},
     *     summary="Muestra un post con la información del autor",
     *
     *     @OA\Parameter(
     *         description="El identificador de un post existente",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Muestra un post y la información del autor."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function show($id)
    {
        $post = $this->postRepository->get($id);

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     tags={"posts"},
     *     summary="Update a post",
     *     @OA\Parameter(
     *         description="El identificador de un post existente",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="userId",
     *                     oneOf={
     *                         @OA\Schema(type="string"),
     *                         @OA\Schema(type="integer"),
     *                     },
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     maxLength=255,
     *                 ),
     *                 @OA\Property(
     *                     property="body",
     *                     type="string",
     *                 ),
     *
     *                 example={"userId": "10", "title": "Una piedra en el camino", "body": "Esto debería ser una historia..."}
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Actualiza un post."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     *
     */
    public function update(PostRequest $request, $id)
    {
        // TODO: (optional) Endpoint PUT para actualizar un post.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO: (optional) Endpoint DELETE para eliminar un post.
    }
}
