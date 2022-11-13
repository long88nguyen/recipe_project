<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Post\PostRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends ApiController
{
    protected $postRepository;


    public function __construct(PostRepository $postRepository)
    {
        return $this->postRepository = $postRepository;
    }

    public function getAll(Request $request)
    {
        $result = $this->postRepository->getAll($request);
        return $this->sendSuccess($result);
    }

    public function store(Request $request)
    {
        $result = $this->postRepository->store($request);
        if (!$result['success']) {

            return $this->sendError($result['code'], $result['status_code'], $result['message']);
        }
        return $this->sendSuccess();
    }
}
