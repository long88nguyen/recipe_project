<?php

namespace App\Repositories\Favourite;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface FavouriteRepository.
 *
 * @package namespace App\Repositories\Favourite;
 */
interface FavouriteRepository extends RepositoryInterface
{
    //
    public function favouritePost($id);

    public function unfavouritePost($id);
}
