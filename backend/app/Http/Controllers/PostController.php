<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = Post::all();
        return response()->json(['posts' => $posts]);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $post = Post::create($request->all());
        return response()->json(['post' => $post]);
    }

    /**
     * @param  Post  $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json(['post' => $post]);
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
     * @param  Request  $request
     * @param  Post  $post
     * @return JsonResponse
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $post->update($request->all());
        return response()->json(['post' => $post]);
    }

    /**
     * @param  Post  $post
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(action('PostController@index'));
    }

    /**
     * @param  Post  $post
     * @return JsonResponse
     */
    public function showComments(Post $post)
    {
        $comments = $post->comments;
        return response()->json(['comments' => $comments]);
    }
}
