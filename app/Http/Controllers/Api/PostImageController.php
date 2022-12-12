<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\PostImage\PostImageRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostImageController extends ApiController
{
    private $postImageRepository ;

    public function __construct(PostImageRepository $postImageRepository)
    {
        return $this->postImageRepository = $postImageRepository;
    }

    public function getAll(Request $request){
        $result = $this->postImageRepository->getAll($request);
        return $this->sendSuccess($result);
    }
}
