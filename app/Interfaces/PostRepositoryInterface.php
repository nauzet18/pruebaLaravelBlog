<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    /**
     * Get all posts.
     *
     * @param int $perPage ?
     * @param int $page    ?
     *
     * @method  GET api/posts
     */
    public function getAll(int $perPage = null, int $page = null): array;

    /**
     * Get Post By ID.
     *
     * @method  GET api/posts/{id}
     */
    public function get(int $id): array;

    /**
     * Create.
     *
     * @method  POST    api/posts       For Create
     */
    public function create(array $data): array;

    /**
     * Update post.
     *
     * @method  PUT     api/posts/{id}  For Update
     */
    public function update(int $id, array $data);

    /**
     * Delete post.
     *
     * @method  DELETE  api/posts/{id}
     */
    public function delete(int $id);
}
