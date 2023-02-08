<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ImageHelper;

class CommonController extends ApiController
{
    public function common()
    {
       $member = Auth::user()->member->id;
       $dataCommon = Member::where('id',$member)->with('UserMember')->first();

       $member_email = Auth::user()->email = '@'.substr(Auth::user()->email,'0',strpos(Auth::user()->email,'@'));
      //  foreach($dataCommon as $item)
      //  {
      //    $item['UserMember']['email'] = 1;
      //  }
        
         // $item['UserMember']['email'] = '@'.substr($item['UserMember']['email'],'0',strpos($item['UserMember']['email'],'@'));
       
    //    $dataCommon->avatar = ImageHelper::getS3FileUrl( $dataCommon->avatar);
       return $this->sendSuccess([
        'member_info' => $dataCommon,
        'member_email' => $member_email
       ]);
    }
}
