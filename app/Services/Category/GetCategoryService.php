<?php

namespace App\Services\Category;

use Illuminate\Http\JsonResponse;
use App\Services\Category\CategoryService;

/**
 * Class RegisterCategoryService
 *
 * @package App\Services\Category
 */
class GetCategoryService extends CategoryService
{
    /**
     * Register new Category
     *
     * @param $request
     * @return mixed
     */
    public function index()
    {
        return $this->repository->index();
    }
}
