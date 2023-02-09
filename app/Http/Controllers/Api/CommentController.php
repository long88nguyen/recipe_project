<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Comment\CommentRepositoryEloquent;
use Illuminate\Http\Request;
class CommentController extends ApiController
{
    protected $commentRepository;
    public function __construct(CommentRepositoryEloquent $commentRepository)
    {
        return $this->commentRepository = $commentRepository;
    }

    public function getByPostId($id,Request $request)
    {
        $result =  $this->commentRepository->getByPostId($id,$request);
        return $this->sendSuccess($result);
    }

    public function Comment(Request $request,$id)
    {
        $result =  $this->commentRepository->Comment($request,$id);
        return $this->sendSuccess($result);
    }

    public function Reply(Request $request,$id)
    {
        $result =  $this->commentRepository->Reply($request,$id);
        return $this->sendSuccess($result);
    }

    public function DeleteComment($id)
    {
        $result =  $this->commentRepository->DeleteComment($id);
        return $this->sendSuccess($result);
    }

    public function reportComment($id)
    {
        $result =  $this->commentRepository->reportComment($id);
        return $this->sendSuccess($result);
    }

    public function reportList()
    {
        $result =  $this->commentRepository->reportList();
        return $this->sendSuccess($result);
    }
}
