<?php

namespace App\Services\Category;

use Illuminate\Http\JsonResponse;
use App\Services\Category\CategoryService;

/**
 * Class RegisterCategoryService
 *
 * @package App\Services\Category
 */
class UpdateCategoryService extends CategoryService
{
    /**
     * Register new Category
     *
     * @param $request
     * @return mixed
     */
    public function updateCategory($id,$data)
    {
        return $this->repository->updateCategory($id,$data);
    }
}
