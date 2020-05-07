<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
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
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $comment = Comment::create($request->all());
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
     * @param  Request  $request
     * @param  Comment  $comment
     * @return JsonResponse
     */
    public function update(Request $request, Comment $comment): JsonResponse
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
