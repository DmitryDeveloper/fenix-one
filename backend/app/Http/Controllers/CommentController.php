<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\CommentService;
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
     * @var CommentService
     */
    protected $commentService;

    /**
     * CategoryController constructor.
     * @param  CommentService  $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $comments = $this->commentService->index();
        return response()->json(['comments' => $comments]);
    }

    /**
     * @param  CommentRequest  $request
     * @return JsonResponse
     */
    public function store(CommentRequest $request): JsonResponse
    {
        $comment = $this->commentService->store($request->all());
        $this->commentService->notifyAuthorAboutComment($comment);
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
        $newComment = $this->commentService->update($request->all(), $comment);
        return response()->json(['comment' => $newComment]);
    }

    /**
     * @param  Comment  $comment
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Comment $comment)
    {
        $this->commentService->destroy($comment);
        return redirect(action('CommentController@index'));
    }
}
