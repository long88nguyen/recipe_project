<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Direction\DirectionRepository;
use Illuminate\Http\Request;

class DirectionController extends ApiController
{
    private $directionRepository ;

    public function __construct(DirectionRepository $directionRepository)
    {
        return $this->directionRepository = $directionRepository;
    }

    public function getAll(Request $request){
        $result = $this->directionRepository->getAll($request);
        return $this->sendSuccess($result);
    }
}
