<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
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
     * @param  CategoryRequest  $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
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
     * @param  CategoryRequest  $request
     * @param  Category  $category
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
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
