<?php

namespace App\Repositories\Rate;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RateRepository.
 *
 * @package namespace App\Repositories\Rate;
 */
interface RateRepository extends RepositoryInterface
{
    public function ratePost($request , $id);

    public function listRate($id);

    public function detail($id);

    public function updateRate($id);

    public function delete($id);
}
