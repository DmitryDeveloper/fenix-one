<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return Comment[]|Collection
     */
    public function getAll()
    {
        return self::all();
    }

    /**
     * @param  mixed  $id
     * @param  array  $columns
     * @return Comment[]|Collection
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
