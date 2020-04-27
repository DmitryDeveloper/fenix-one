<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Comment;
use App\User;

/**
 * Class Post
 * @package App
 */
class Post extends Model
{
    /**
     * The attributes that are mass assignable.     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'text'
    ];

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
