<?php

namespace App\Repositories\Banner;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BannerRepository.
 *
 * @package namespace App\Repositories\Banner;
 */
interface BannerRepository extends RepositoryInterface
{
    //

    public function getAll($request);

    public function store($request);

    public function bannerDetail($id);

    public function updateBanner($request,$id);

    public function deleteBanner($id);

    public function bannerUser();
}

