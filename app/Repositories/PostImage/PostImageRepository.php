<?php

namespace App\Repositories\PostImage;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PostImageRepository.
 *
 * @package namespace App\Repositories\PostImage;
 */
interface PostImageRepository extends RepositoryInterface
{
    //
    public function getAll($request);
}
