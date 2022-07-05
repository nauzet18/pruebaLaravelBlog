<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\View\View;

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
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        try {
            $perPage = 10;
            $page = request('page', 1);

            $posts = $this->postRepository->getAll($perPage, $page);

            // En las vistas añado un paginador
            // TODO: me gustaría hacer q el postRepository, devolviera Collection en vez de array, pero para otra.
            $posts = $posts instanceof Collection ? $posts : Collection::make($posts);
            $posts = new LengthAwarePaginator($posts->forPage($page, $perPage), $posts->count(), $perPage, $page);
        } catch (\Exception $e) {
            abort(404, 'Upss !!!'.$e->getMessage());
        }

        return view('posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id): View
    {
        try {
            $post = $this->postRepository->get($id);
        } catch (\Exception $e) {
            abort(404, 'Upss !!!'.$e->getMessage());
        }

        return view('posts.show', compact('post'));
    }
}
