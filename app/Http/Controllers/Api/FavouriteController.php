<?php

namespace App\Http\Controllers\Api;

use App\Enums\ErrorType;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Favourite\FavouriteRepository;
use Illuminate\Http\Request;

class FavouriteController extends ApiController
{
    protected $favouriteRepository ;
     
    public function __construct(
        FavouriteRepository $favouriteRepository
    )
    {
        return $this->favouriteRepository =  $favouriteRepository;
    }

    public function favouritePost($id)
    {
        $result = $this->favouriteRepository->favouritePost($id);
        if (!$result['success']) {
            return $this->sendError($result['code'], $result['status_code'], $result['message']);
        }
        return $this->sendSuccess();
    }

    public function unfavouritePost($id)
    {
        $result = $this->favouriteRepository->unfavouritePost($id);
        if (!$result['success']) {
            return $this->sendError($result['code'], $result['status_code'], $result['message']);
        }
        return $this->sendSuccess();
    }
}
