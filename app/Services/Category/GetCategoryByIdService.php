<?php

namespace App\Services\Category;

use Illuminate\Http\JsonResponse;
use App\Services\Category\CategoryService;

/**
 * Class RegisterCategoryService
 *
 * @package App\Services\Category
 */
class GetCategoryByIdService extends CategoryService
{
    /**
     * Register new Category
     *
     * @param $request
     * @return mixed
     */
    public function show($id)
    {
        return $this->repository->show($id);
    }
}
