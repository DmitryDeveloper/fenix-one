<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use App\Services\FileService;
use App\Http\Requests\PostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Exception;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * @var PostService
     */
    protected $postService;

    /**
     * @var FileService
     */
    protected $fileService;

    /**
     * PostController constructor.
     * @param  PostService  $postService
     * @param  FileService  $fileService
     */
    public function __construct(
        PostService $postService,
        FileService $fileService
    ) {
        $this->postService = $postService;
        $this->fileService = $fileService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = $this->postService->index();
        return response()->json(['posts' => $posts]);
    }

    /**
     * @param  PostRequest  $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        $post = $this->postService->store($request->all());
        $this->fileService->storeImage($request, 'posts', $post->id);
        return response()->json(['post' => $post]);
    }

    /**
     * @param  Post  $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        $image = $this->fileService->getImage('posts', $post->id);
        return response()->json(['post' => $post, 'image' => $image]);
    }

    /**
     * @param  Post  $post
     * @return JsonResponse
     */
    public function edit(Post $post): JsonResponse
    {
        return response()->json(['post' => $post]);
    }

    /**
     * @param  PostRequest  $request
     * @param  Post  $post
     * @return JsonResponse
     */
    public function update(PostRequest $request, Post $post): JsonResponse
    {
        $newPost = $this->postService->update($request->all(), $post);
        return response()->json(['post' => $newPost]);
    }

    /**
     * @param  Post  $post
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $this->postService->destroy($post);
        return redirect(action('PostController@index'));
    }

    /**
     * @param  Post  $post
     * @return JsonResponse
     */
    public function showComments(Post $post): JsonResponse
    {
        $comments = $post->comments;
        return response()->json(['comments' => $comments]);
    }
}
