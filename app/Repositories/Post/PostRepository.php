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
    public function getListApproved($request);

    public function getAll($request);

    public function store($request);

    public function showCreate();

    public function detail($id);

    public function update($request,$id);

    public function delete($id);

    public function approve($request,$id);

    public function SearchPost($request);

    public function GetListFavourite();

    public function MyPost();

    public function YourPost($id);

}
