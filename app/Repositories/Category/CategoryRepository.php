<?php

namespace App\Repositories\Category;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository.
 *
 * @package namespace App\Repositories\Category;
 */
interface CategoryRepository extends RepositoryInterface
{
    public function getAll($request);

    public function store($request);

    public function show($id);

    public function updateCategory($id,$data);

    public function delete($id);
}
