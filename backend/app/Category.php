<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    /**
     * The attributes that are mass assignable.     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
