<?php

namespace App\Interfaces;

use App\Http\Requests\PostRequest;

interface PostRepositoryInterface
{
    /**
     * Get all posts
     *
     * @method  GET api/posts
     * @access  public
     */
     public function getAll();

    /**
     * Get Post By ID
     *
     * @param   integer     $id
     *
     * @method  GET api/posts/{id}
     * @access  public
     */
    public function get(int $id);

    /**
     * Create
     *
     * @param   \App\Http\Requests\PostRequest    $request
     * @param   integer                           $id
     *
     * @method  POST    api/posts       For Create
     * @access  public
     */
    public function create(PostRequest $request);

    /**
     * Update post
     *
     * @param   \App\Http\Requests\PostRequest    $request
     * @param   integer                           $id
     *
     * @method  PUT     api/posts/{id}  For Update
     * @access  public
     */
    public function update(PostRequest $request, int $id);

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