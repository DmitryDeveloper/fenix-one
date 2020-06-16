<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\EmailService;

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
    public function notifyAuthorAboutComment(): Comment
    {
        $post = Post::findOrFail($this->post_id);
        $authorPost = $post->user;
        if (!($this->user_id == $authorPost->id) && $post->email_checkbox) {
            $authorComment = User::findOrFail($this->user_id);
            $name = "$authorComment->first_name $authorComment->last_name";
            EmailService::sendMessage(
                "User $name left commentary under your post",
                $authorComment->email,
                $authorPost->email,
                'Notice'
            );
        }
        return $this;
    }
}
