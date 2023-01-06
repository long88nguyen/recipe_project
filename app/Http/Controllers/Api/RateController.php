<?php

namespace App\Http\Controllers\Api;

use App\Enums\ErrorType;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Rate\RateRepository;
use Illuminate\Http\Request;

class RateController extends ApiController
{
    protected $rateRepository; 

    public function __construct(RateRepository $rateRepository)
    {
            return $this->rateRepository = $rateRepository;
    }
    public function ratePost(Request $request,$id)
    {
        $result = $this->rateRepository->ratePost($request->all(),$id);
        if (!$result['success']) {

            return $this->sendError($result['code'], $result['status_code'], $result['message']);
        }
        return $this->sendSuccess();
    }

    public function getALl(Request $request)
    {
        $result = $this->rateRepository->getAll($request);
        return $this->sendSuccess($result);
    }

    public function listRate($id)
    {
        $result = $this->rateRepository->listRate($id);
        return $this->sendSuccess($result);
    }

    public function StatRate($id)
    {
        $result = $this->rateRepository->StatRate($id);
        return $this->sendSuccess($result);
    }

    public function detail($id)
    {
        $result = $this->rateRepository->detail($id);
        return $this->sendSuccess($result);
    }

    public function updateRate(Request $request,$id)
    {
        $result = $this->rateRepository->updateRate($request,$id);
        return $this->sendSuccess($result);
    }

    public function delete($id)
    {
        $result = $this->rateRepository->delete($id);
        return $this->sendSuccess($result);
    }
}
