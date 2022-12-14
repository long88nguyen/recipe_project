<?php

namespace App\Http\Controllers\Api;

use App\Enums\ErrorType;
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

    public function SearchPost(Request $request)
    {
        $result = $this->postRepository->SearchPost($request);
        return $this->sendSuccess($result);
    }

    public function getListApproved(Request $request)
    {
        $result = $this->postRepository->getListApproved($request);
        return $this->sendSuccess($result);
    }

    public function showApproval($id)
    {
        $result =  $this->postRepository->showApproval($id);
        return $this->sendSuccess($result);
    }

    public function store(Request $request)
    {
        $result = $this->postRepository->store($request);
        if (!$result['success']) {

            return $this->sendError(ErrorType::CODE_5000, ErrorType::STATUS_5000, $result['message']);
        }
        return $this->sendSuccess();
    }

    public function create()
    {
        $result = $this->postRepository->showCreate();
        return $this->sendSuccess($result);
    }

    public function edit($id)
    {
        $result = $this->postRepository->edit($id);
        return $this->sendSuccess($result);
    }

    public function update(Request $request ,$id)
    {
        $result = $this->postRepository->update($request->all(),$id);
        if (!$result['success']) {

            return $this->sendError(ErrorType::CODE_5000, ErrorType::STATUS_5000, $result['message']);
        }
        return $this->sendSuccess();
    }

    public function delete($id)
    {
        $result = $this->postRepository->delete($id);
        if (!$result['success']) {
            return $this->sendError(ErrorType::CODE_5000, ErrorType::STATUS_5000, $result['message']);
        }
        return $this->sendSuccess();
    }

    public function approve(Request $request,$id)
    {
        $result = $this->postRepository->approve($request,$id);
        if (!$result['success']) {
            return $this->sendError(ErrorType::CODE_5000, ErrorType::STATUS_5000, $result['message']);
        }
        return $this->sendSuccess();
    }
}
