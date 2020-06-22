<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Exception;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService
{
    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryService constructor.
     * @param  Category  $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Category[]|Collection
     */
    public function index()
    {
        return $this->category->getAll();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        return $this->category->store($request);
    }

    /**
     * @param $request
     * @param  Category  $category
     * @return Category
     */
    public function update($request, Category $category): Category
    {
        return $category->upgrade($request);
    }

    /**
     * @param  Category  $category
     * @return bool|JsonResponse|null
     */
    public function destroy(Category $category)
    {
        try {
            return $category->remove();
        } catch (Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
