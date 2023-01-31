<?php

namespace App\Repositories\Member;

use App\Models\Member;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Member\MemberRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use FormatHelper;
use App\Validators\Member\MemberValidator;
use ImageHelper;

/**
 * Class MemberRepositoryEloquent.
 *
 * @package namespace App\Repositories\Member;
 */
class MemberRepositoryEloquent extends BaseRepository implements MemberRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Member::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAll($request){
        $listMember = $this->model->with('UserMember');
        if(isset($request->name))
        {
            $listMember=$listMember->where('name', 'like', '%' . $request->name . '%');
        }

        $listMember = $listMember->paginate(5);
        // foreach($listMember as $item)
        // {
        //     $item->avatar = ImageHelper::getS3FileUrl($item->avatar);
        // }
        
        return [
            "listMember" => $listMember,
        ];
    }

    public function detail($id)
    {
        $memberId = $this->model->find($id);
        // $memberId->avatar = ImageHelper::getS3FileUrl($memberId->avatar);
        return [
            "memberId" => $memberId,
        ];
    }
    
    public function updateMember($request, $id)
    {
        $updateData = $this->model->find($id);
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['birthday'] = $request->birthday;
        $data['gender'] = $request->gender ? $request->gender != null : null ;
        if ($request->file('avatar'))
        {
            // $data['avatar'] = ImageHelper::updateFileFromS3($request->file('avatar'),$updateData->avatar,'images/avatars');
            if(File::exists("uploads/avatars/".$updateData->avatar))
            {
                File::delete("uploads/avatars/".$updateData->avatar);
            }
            $image = $request->file('avatar');
            $destinationPath = public_path('uploads/avatars');
            $profileImage = "/uploads/avatars/".date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['avatar'] = $profileImage;
        }

        return $updateData->update($data);

    }

    public function PostsByMember(){
         $postsMember = $this->model->with('UserMember:id,email')
         
         ->select('members.avatar','members.id','members.name','members.user_id',DB::raw('(select count(*) from posts where posts.member_id = members.id and posts.status = 2) as count_posts'))->get();
         foreach($postsMember as $item)
         {
            // $item->avatar = ImageHelper::getS3FileUrl($item->avatar);
            // dd(ImageHelper::getS3FileUrl($item->avatar));
            $item['UserMember']['email'] = '@'.substr($item['UserMember']['email'],'0',strpos($item['UserMember']['email'],'@'));
         }
         return [
            'postsMember' => $postsMember 
         ];

    }

    public function memberDetail($id)
    {
        $dataMemberDetail = Member::where('id',$id)->with('UserMember:id,email')->first();
        $dataMemberDetail['UserMember']['email'] = '@'.substr($dataMemberDetail['UserMember']['email'],'0',strpos($dataMemberDetail['UserMember']['email'],'@'));
        return [
            'dataMemberDetail' =>  $dataMemberDetail 
        ];
    }
}
