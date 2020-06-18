<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Exception;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $comments = Comment::all();
        return response()->json(['comments' => $comments]);
    }

    /**
     * @param  CommentRequest  $request
     * @return JsonResponse
     */
    public function store(CommentRequest $request): JsonResponse
    {
        $comment = new Comment($request->all());
        $comment->notifyAuthorAboutComment()->save();
        return response()->json(['comment' => $comment]);
    }

    /**
     * @param  Comment  $comment
     * @return JsonResponse
     */
    public function show(Comment $comment): JsonResponse
    {
        return response()->json(['comment' => $comment]);
    }

    /**
     * @param  Comment  $comment
     * @return JsonResponse
     */
    public function edit(Comment $comment): JsonResponse
    {
        return response()->json(['comment' => $comment]);
    }

    /**
     * @param  CommentRequest  $request
     * @param  Comment  $comment
     * @return JsonResponse
     */
    public function update(CommentRequest $request, Comment $comment): JsonResponse
    {
        $comment->update($request->all());
        return response()->json(['comment' => $comment]);
    }

    /**
     * @param  Comment  $comment
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect(action('CommentController@index'));
    }
}
