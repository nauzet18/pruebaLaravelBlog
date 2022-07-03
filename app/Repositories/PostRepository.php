<?php

namespace App\Repositories;

use App\Http\Requests\PostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\PersistenceServiceInterface;

class PostRepository implements PostRepositoryInterface
{
    private PersistenceServiceInterface $persistence;

    public function __construct(PersistenceServiceInterface $persistence)
    {
      $this->persistence = $persistence;
    }

    /**
     * Get all posts
     *
     * @method  GET api/posts
     * @access  public
     */
    public function getAll()
    {
      try {
        //TODO :  Endpoint GET para la obtención de posts (y en cada post incluir la información del autor)
        $posts = $this->persistence->all();

        return $posts;

      } catch(\Exception $e) {
          throw  $e;
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
            $post = $this->persistence->retrieve( $id );

            if(!$post)
                throw new OutOfBoundsException("No post found for ID  $id");

            return $post;

        } catch(\Exception $e) {
            throw  $e;
        }
    }

    /**
     * Create
     *
     * @param   array    $data
     *
     * @method  POST    api/posts       For Create
     * @access  public
     */
    public function create(array $data): array
    {
        //DB::beginTransaction();
        try {
            $post = $this->persistence->persist( $data );

            if(!$post)
              throw new Exception("No created post");

            //DB::commit();
            return $post;

        } catch(\Exception $e) {
            //DB::rollBack();
            throw  $e;
        }
    }

    /**
     * Update post
     *
     * @param   integer  $id
     * @param   array    $data
     *
     * @method  PUT     api/posts/{id}  For Update
     * @access  public
     */
    public function update(int $id, array $data)
    {
        //DB::beginTransaction();
        try {
            $post = $this->persistence->update( $id, $data );

            if(!$post)
                throw new OutOfBoundsException("No post found for ID  $id");

            //DB::commit();
            return $post;

        } catch(\Exception $e) {
            //DB::rollBack();
            throw  $e;
        }
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
            $this->persistence->delete($id);

            //DB::commit();
            return;

        } catch(\Exception $e) {
            //DB::rollBack();
            throw  $e;
        }
    }
}
