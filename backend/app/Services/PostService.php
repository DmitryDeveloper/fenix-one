<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 * Class PostService
 * @package App\Services
 */
class PostService
{
    /**
     * @var Post
     */
    private $post;

    /**
     * PostService constructor.
     * @param  Post  $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Post[]|Collection
     */
    public function index()
    {
        return $this->post->getAll();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return $this->post->store($request);
    }

    /**
     * @param $request
     * @param  Post  $post
     * @return Post
     */
    public function update($request, Post $post): Post
    {
        return $post->upgrade($request);
    }

    /**
     * @param  Post  $post
     * @return bool|JsonResponse|null
     */
    public function destroy(Post $post)
    {
        try {
            return $post->remove();
        } catch (Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
