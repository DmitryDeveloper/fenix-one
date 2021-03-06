<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const USER = 'user';
    const MODERATOR = 'moderator';
    const ADMINISTRATOR = 'administrator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * @return User[]|Collection
     */
    public function getAll()
    {
        return self::all();
    }

    /**
     * @param  mixed  $id
     * @param  array  $columns
     * @return User[]|Collection
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
