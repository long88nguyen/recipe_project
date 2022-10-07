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
    public function index();

    public function store($request);

    public function show($id);

    public function updateCategory($id,$request);

    public function delete($id);
}
