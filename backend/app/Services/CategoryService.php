<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Redis;

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
     * @var RedisService
     */
    private $redisService;

    /**
     * CategoryService constructor.
     * @param  Category  $category
     * @param  RedisService  $redisService
     */
    public function __construct(
        Category $category,
        RedisService $redisService
    ) {
        $this->category = $category;
        $this->redisService = $redisService;
    }


    public function index()
    {
        $res = Redis::connection();

        //$res = $this->redisService->get('qqq');
        //$res = $this->redisService->flushAll();

        return $res->get('qqq');

        //return $this->category->getAll();
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
