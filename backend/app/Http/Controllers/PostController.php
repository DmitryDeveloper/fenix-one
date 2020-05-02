<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(['posts' => Post::all()]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json(['post' => Post::create($request->all())]);
    }

    /**
     * @param $post
     * @return JsonResponse
     */
    public function show($post)
    {
        return response()->json(['post' => Post::findOrFail($post)]);
    }

    /**
     * @param $post
     * @return Application|Factory|View
     */
    public function edit($post)
    {
        return view('posts.edit', ['post' => Post::findOrFail($post)]);
    }

    /**
     * @param  Request  $request
     * @param $post
     * @return JsonResponse
     */
    public function update(Request $request, $post)
    {
        return response()->json(['post' => Post::findOrFail($post)->update($request->all())]);
    }

    /**
     * @param $post
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($post)
    {
        Post::destroy($post);
        return redirect(action('PostController@index'));
    }
}
