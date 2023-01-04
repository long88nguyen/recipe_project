<?php

namespace App\Repositories\Member;

use App\Models\Member;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Member\MemberRepository;
use Illuminate\Support\Facades\File;
use FormatHelper;
use App\Validators\Member\MemberValidator;

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
        $listMember = $this->model;
        if(isset($request->name))
        {
            $listMember=$listMember->where('name', 'like', '%' . $request->name . '%');
        }

        $listMember = $listMember->paginate(5);
        return [
            "listMember" => $listMember,
        ];
    }

    public function detail($id)
    {
        $memberId = $this->model->find($id);
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
        $data['gender'] = $request->gender;
        if ($request->file('avatar'))
        {
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
}
