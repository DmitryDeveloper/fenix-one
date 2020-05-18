<?php

namespace App\Http\Controllers;

use App\User;
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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    /**
     * @param  UserRequest  $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $user = User::create($request->all());
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
        $user->update($request->all());
        return response()->json(['user' => $user]);
    }

    /**
     * @param  User  $user
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(action('UserController@index'));
    }
}
