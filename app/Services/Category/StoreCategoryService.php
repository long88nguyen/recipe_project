<?php

namespace App\Services\Category;

use Illuminate\Http\JsonResponse;
use App\Services\Category\CategoryService;

/**
 * Class RegisterCategoryService
 *
 * @package App\Services\Category
 */
class StoreCategoryService extends CategoryService
{
    /**
     * Register new Category
     *
     * @param $request
     * @return mixed
     */
    public function store($data)
    {
        return $this->repository->store($data);
    }
}
