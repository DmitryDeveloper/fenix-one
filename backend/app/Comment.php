<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\MailgunService;

/**
 * Class Comment
 * @package App
 */
class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'text'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Send the notice to author of post when somebody has left commentary
     *
     * @return $this
     */
    public function notifyAuthor(): Comment
    {
        $post = Post::findOrFail($this->post_id);
        $author_post = $post->user;
        if (!($this->user_id == $author_post->id) && $post->email_checkbox) {
            $author_comment = User::findOrFail($this->user_id);
            $name = "$author_comment->first_name $author_comment->last_name";
            MailgunService::sendMessage(
                "User $name left commentary under your post",
                $author_comment->email,
                $author_post->email,
                'Notice'
            );
        }
        return $this;
    }
}
