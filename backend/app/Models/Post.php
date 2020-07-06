<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'user_id',
        'title',
        'text'
    ];

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return Post[]|Collection
     */
    public function getAll()
    {
        return self::all();
    }

    /**
     * @param  mixed  $id
     * @param  array  $columns
     * @return Post[]|Collection
     */
    public function get($id, $columns = ['*'])
    {
        return self::findOrFail($id, $columns);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return self::create($request);
    }

    /**
     * @param $request
     * @return $this
     */
    public function upgrade($request): self
    {
        $this->update($request);
        return $this;
    }

    /**
     * @return bool|null
     * @throws Exception
     */
    public function remove(): ?bool
    {
        return $this->delete();
    }
}
