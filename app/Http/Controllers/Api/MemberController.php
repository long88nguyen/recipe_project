<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Member\MemberRepository;
use Illuminate\Http\Request;


class MemberController extends ApiController
{
    protected $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        return $this->memberRepository = $memberRepository;
    }

    public function getALl(Request $request)
    {
        $result = $this->memberRepository->getAll($request);
        return $this->sendSuccess($result);
    }
}
