<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
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
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * CategoryController constructor.
     * @param  CategoryService  $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = $this->categoryService->index();
        return response()->json(['categories' => $categories]);
    }

    /**
     * @param  CategoryRequest  $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->store($request->all());
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
        $newCategory = $this->categoryService->update($request->all(), $category);
        return response()->json(['category' => $newCategory]);
    }

    /**
     * @param  Category  $category
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $this->categoryService->destroy($category);
        return redirect(action('CategoryController@index'));
    }
}
