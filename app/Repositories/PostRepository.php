<?php

namespace App\Repositories;

use App\Interfaces\PersistenceServiceInterface;
use App\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    private PersistenceServiceInterface $persistence;

    public function __construct(PersistenceServiceInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * Get all posts
     * A todos los post se le carga la información del usuario, pero he hecho la optimización para que si se pasan
     * los parametros de paginación solo se cargan para esos elementos.
     *
     * @param int $perPage ?
     * @param int $page    ?
     *
     * @method  GET api/posts
     */
    public function getAll(int $perPage = null, int $page = null): array
    {
        try {
            $posts = $this->persistence->all();

            if (!empty($perPage) && !empty($page)) {
                foreach (range(0, $perPage - 1) as $i) {
                    // * $perPage
                    $index = $perPage * ($page - 1) + $i;
                    if (isset($posts[$index])) {
                        $posts[$index]['user'] = $this->persistence->getUser($posts[$index]['userId']);
                    }
                }
            } else {
                foreach ($posts as &$post) {
                    $post['user'] = $this->persistence->getUser($post['userId']);
                }
            }

            return $posts;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Get Post By ID.
     *
     * @method  GET api/posts/{id}
     */
    public function get(int $id): array
    {
        try {
            $post = $this->persistence->retrieve($id);

            $post['user'] = $this->persistence->getUser($post['userId']);

            return $post;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Create.
     *
     * @method  POST    api/posts       For Create
     */
    public function create(array $data): array
    {
        // DB::beginTransaction();
        try {
            $post = $this->persistence->persist($data);

            if (!$post) {
                throw new Exception('No created post');
            }

            // DB::commit();
            return $post;
        } catch (\Exception $e) {
            // DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update post.
     *
     * @method  PUT     api/posts/{id}  For Update
     */
    public function update(int $id, array $data)
    {
        // DB::beginTransaction();
        try {
            $post = $this->persistence->update($id, $data);

            if (!$post) {
                throw new OutOfBoundsException("No post found for ID  $id");
            }

            // DB::commit();
            return $post;
        } catch (\Exception $e) {
            // DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete post.
     *
     * @method  DELETE  api/posts/{id}
     */
    public function delete(int $id)
    {
        // DB::beginTransaction();
        try {
            $this->persistence->delete($id);

            // DB::commit();
            return;
        } catch (\Exception $e) {
            // DB::rollBack();
            throw $e;
        }
    }
}
