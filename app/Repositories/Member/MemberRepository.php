<?php

namespace App\Repositories\Member;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface MemberRepository.
 *
 * @package namespace App\Repositories\Member;
 */
interface MemberRepository extends RepositoryInterface
{
    public function getAll($request);
}
