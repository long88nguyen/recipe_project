<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ImageHelper;

class CommonController extends ApiController
{
    public function common()
    {
       $dataCommon = Auth::user()->member;
       $dataCommon->avatar = ImageHelper::getS3FileUrl( $dataCommon->avatar);
       return $this->sendSuccess([
        'member_info' => $dataCommon
       ]);
    }
}
