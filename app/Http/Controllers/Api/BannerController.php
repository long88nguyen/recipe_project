<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Banner\BannerRepositoryEloquent;
use Illuminate\Http\Request;

class BannerController extends ApiController
{
    protected $bannerRepository;

    public function __construct(BannerRepositoryEloquent $bannerRepository)
    {
        return $this->bannerRepository = $bannerRepository;
    }

    public function getAll(Request $request)
    {
        $result =  $this->bannerRepository->getAll($request);
        return $this->sendSuccess($result);
    }

    public function store(Request $request){
        $result =  $this->bannerRepository->store($request);
        return $this->sendSuccess($result);
    }

    public function bannerDetail($id){
        $result =  $this->bannerRepository->bannerDetail($id);
        return $this->sendSuccess($result);
    }

    public function updateBanner(Request $request,$id){
        $result =  $this->bannerRepository->updateBanner($request,$id);
        return $this->sendSuccess($result);
    }

    public function deleteBanner($id){
        $result =  $this->bannerRepository->deleteBanner($id);
        return $this->sendSuccess($result);
    }
    //
}
