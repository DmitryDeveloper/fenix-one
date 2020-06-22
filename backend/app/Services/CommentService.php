<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 * Class CommentService
 * @package App\Services
 */
class CommentService
{
    /**
     * @var Comment
     */
    private $comment;

    /**
     * CommentService constructor.
     * @param  Comment  $comment
     */
    public function __construct(
        Comment $comment
    ) {
        $this->comment = $comment;
    }

    /**
     * @return Comment[]|Collection
     */
    public function index()
    {
        return $this->comment->getAll();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return $this->comment->store($request);
    }

    /**
     * @param $request
     * @param  Comment  $comment
     * @return Comment
     */
    public function update($request, Comment $comment): Comment
    {
        return $comment->upgrade($request);
    }

    /**
     * @param  Comment  $comment
     * @return bool|JsonResponse|null
     */
    public function destroy(Comment $comment)
    {
        try {
            return $comment->remove();
        } catch (Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    /**
     * Send the notice to author of post when somebody has left commentary
     *
     * @param $comment
     * @return CommentService
     */
    public function notifyAuthorAboutComment($comment): CommentService
    {
        $post = $comment->post;
        if ($post->email_checkbox) {
            $authorComment = $comment->user;
            $authorPost = $post->user;
            if ($authorComment->id !== $authorPost->id) {
                $name = "$authorComment->first_name $authorComment->last_name";
                EmailService::sendMessage(
                    "User $name left commentary under your post",
                    $authorComment->email,
                    $authorPost->email,
                    'Notice'
                );
            }
        }
        return $this;
    }
}
