<?php

namespace App\Repositories\Post;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PostRepository.
 *
 * @package namespace App\Repositories\Post;
 */
interface PostRepository extends RepositoryInterface
{
    //
    public function getAll($request);

    public function store($request);

    public function showCreate();

    public function edit($id);

    public function update($request,$id);

    public function delete($id);

    public function approve($request,$id);
}
