<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(['users' => User::all()]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json(['user' => User::create($request->all())]);
    }

    /**
     * @param $user
     * @return JsonResponse
     */
    public function show($user)
    {
        return response()->json(['user' => User::findOrFail($user)]);
    }

    /**
     * @param $user
     * @return Application|Factory|View
     */
    public function edit($user)
    {
        return view('users.edit', ['user' => User::findOrFail($user)]);
    }

    /**
     * @param  Request  $request
     * @param $user
     * @return JsonResponse
     */
    public function update(Request $request, $user)
    {
        return response()->json(['user' => User::findOrFail($user)->update($request->all())]);
    }

    /**
     * @param $user
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($user)
    {
        User::destroy($user);
        return redirect(action('UserController@index'));
    }
}
