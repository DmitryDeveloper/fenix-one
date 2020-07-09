<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class SendEmails
 * @package App\Jobs
 */
class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Comment
     */
    protected $comment;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create a new job instance.
     *
     * SendEmails constructor.
     * @param  Comment  $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @param  CommentService  $commentService
     * @return void
     */
    public function handle(CommentService $commentService): void
    {
        $commentService->notifyAuthorAboutComment($this->comment);
    }
}
