<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserService constructor.
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User[]|Collection
     */
    public function index()
    {
        return $this->user->getAll();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return $this->user->store($request);
    }

    /**
     * @param $request
     * @param  User  $user
     * @return User
     */
    public function update($request, User $user): User
    {
        return $user->upgrade($request);
    }

    /**
     * @param  User  $user
     * @return bool|JsonResponse|null
     */
    public function destroy(User $user)
    {
        try {
            return $user->remove();
        } catch (Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
