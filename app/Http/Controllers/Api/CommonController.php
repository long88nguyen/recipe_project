<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends ApiController
{
    public function common()
    {
       $dataCommon = Auth::user()->member;
       return $this->sendSuccess([
        'member_info' => $dataCommon
       ]);
    }
}
