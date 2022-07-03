<?php

namespace App\Repositories;

use App\Http\Requests\PostRequest;
use App\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Get all posts
     *
     * @method  GET api/posts
     * @access  public
     */
    public function getAll()
    {
      try {
        //TODO: quitar el factory
        //TODO :  Endpoint GET para la obtención de posts (y en cada post incluir la información del autor)
        $posts = \App\Factories\PostFactory::new()->times(5)->make();

        return $posts;

      } catch(\Exception $e) {
        return $this->error($e->getMessage(), $e->getCode());
      }

    }

    /**
     * Get Post By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/posts/{id}
     * @access  public
     */
    public function get(int $id)
    {
        try {
            //TODO: quitar el factory
            $post = \App\Factories\PostFactory::new()->make();

            // Check the post
            if(!$post) return $this->error("No post with ID $id", 404);

            return $post;

        } catch(\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Create
     *
     * @param   \App\Http\Requests\PostRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/posts       For Create
     * @access  public
     */
    public function create(PostRequest $request)
    {
      //TOD
    }

    /**
     * Update post
     *
     * @param   \App\Http\Requests\PostRequest    $request
     * @param   integer                           $id
     *
     * @method  PUT     api/posts/{id}  For Update
     * @access  public
     */
    public function update(PostRequest $request, int $id)
    {
      //TOD
    }


    /**
     * Delete post
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/posts/{id}
     * @access  public
     */
    public function delete(int $id)
    {
        //DB::beginTransaction();
        try {
            //TODO: quitar el factory
            $post = \App\Factories\PostFactory::new()->make();

            // Check the post
            if(!$post) return $this->error("No post with ID $id", 404);

            // Delete the post
            $post->delete();

            //DB::commit();
            return $post;

        } catch(\Exception $e) {
            //DB::rollBack();
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
