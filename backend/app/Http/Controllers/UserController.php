<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Exception;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * UserController constructor.
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = $this->userService->index();
        return response()->json(['users' => $users]);
    }

    /**
     * @param  UserRequest  $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $user = $this->userService->store($request->all());
        return response()->json(['user' => $user]);
    }

    /**
     * @param  User  $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json(['user' => $user]);
    }

    /**
     * @param  User  $user
     * @return JsonResponse
     */
    public function edit(User $user): JsonResponse
    {
        return response()->json(['user' => $user]);
    }

    /**
     * @param  UserRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        $newUser = $this->userService->update($request->all(), $user);
        return response()->json(['user' => $newUser]);
    }

    /**
     * @param  User  $user
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $this->userService->destroy($user);
        return redirect(action('UserController@index'));
    }
}
