<?php

namespace App\Interfaces;

use App\Http\Requests\PostRequest;

interface PostRepositoryInterface
{
    /**
     * Get all posts
     *
     * @param   integer     $perPage ?
     * @param   integer     $page ?
     *
     * @method  GET api/posts
     * @access  public
     */
     public function getAll(int $perPage = null,int $page = null): array;

    /**
     * Get Post By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/posts/{id}
     * @access  public
     */
    public function get(int $id): array;

    /**
     * Create
     *
     * @param   array    $data
     *
     * @method  POST    api/posts       For Create
     * @access  public
     */
    public function create(array $data): array;

    /**
     * Update post
     *
     * @param   integer  $id
     * @param   array    $data
     *
     * @method  PUT     api/posts/{id}  For Update
     * @access  public
     */
    public function update(int $id, array $data);

    /**
     * Delete post
     *
     * @param   integer     $id
     *
     * @method  DELETE  api/posts/{id}
     * @access  public
     */
    public function delete(int $id);
}