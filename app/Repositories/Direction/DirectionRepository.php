<?php

namespace App\Repositories\Direction;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface DirectionRepository.
 *
 * @package namespace App\Repositories\Direction;
 */
interface DirectionRepository extends RepositoryInterface
{
    //
    public function getAll($request);
}
