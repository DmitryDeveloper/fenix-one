<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentLeft;

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
     * @param  PostRequest  $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
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
     * @param  PostRequest  $request
     * @param  Post  $post
     * @return JsonResponse
     */
    public function update(PostRequest $request, Post $post): JsonResponse
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
    public function showComments(Post $post): JsonResponse
    {
        $comments = $post->comments;
        return response()->json(['comments' => $comments]);
    }

    public function testEmail(Post $post)
    {
        $user = $post->user;
        $name = $user->first_name;
        $text = 'comment was left by ' . $name;
        Mail::raw($text, function ($message) {
            $message->to('ivanenkoaleksei@mail.ru');
        });

//        return response()->json('Email sent Successfully');
    }
}
