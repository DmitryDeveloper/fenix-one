<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Exception;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories]);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $category = Category::create($request->all());
        return response()->json(['category' => $category]);
    }

    /**
     * @param  Category  $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json(['category' => $category]);
    }

    /**
     * @param  Category  $category
     * @return JsonResponse
     */
    public function edit(Category $category): JsonResponse
    {
        return response()->json(['category' => $category]);
    }

    /**
     * @param  Request  $request
     * @param  Category  $category
     * @return JsonResponse
     */
    public function update(Request $request, Category $category): JsonResponse
    {
        $category->update($request->all());
        return response()->json(['category' => $category]);
    }

    /**
     * @param  Category  $category
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(action('CategoryController@index'));
    }
}
