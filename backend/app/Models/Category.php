<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * @return Category[]|Collection
     */
    public function getAll()
    {
        return self::all();
    }

    /**
     * @param  mixed  $id
     * @param  array  $columns
     * @return Category[]|Collection
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
