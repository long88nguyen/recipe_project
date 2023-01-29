<?php

namespace App\Repositories\Banner;

use App\Models\Banner;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Banner\BannerRepository;
use Illuminate\Support\Facades\File;
use App\Validators\Banner\BannerValidator;

/**
 * Class BannerRepositoryEloquent.
 *
 * @package namespace App\Repositories\Banner;
 */
class BannerRepositoryEloquent extends BaseRepository implements BannerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Banner::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function getAll($request)
    {
        $dataBanner = $this->model->orderBy('id','DESC')->paginate(5);
        return [
            'dataBanner' => $dataBanner
        ];
    }

    public function store($request)
    {
        $timeNow = now();
        $data = [];
        if($request->file('image'))
        {
            $image = $request->file('image');
            $destinationPath = public_path('uploads/banners');
            $profileImage = '/uploads/banners/' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = $profileImage;
        }
        $data['content'] = $request->content ? $request->content : null;
        $data['is_active'] = 1;
        $data['created_at'] = $timeNow;
        $data['updated_at'] = $timeNow;
        return $this->model->create($data);
    }
    

    public function bannerDetail($id)
    {
        $bannerDetail = $this->model->find($id);
        return $bannerDetail;
    }

    public function updateBanner($request,$id)
    {
        $banner = $this->model->findOrFail($id);
        if ($request->file('image'))
        {
            if(File::exists(mb_substr($banner->image,strpos($banner->image, "_") + 1)))
            {
                File::delete(mb_substr($banner->image,strpos($banner->image, "_") + 1));
            }
            $image = $request->file('image');
            $destinationPath = public_path('uploads/banners');
            $profileImage = '/uploads/banners/' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = $profileImage;
            // $data['image'] = ImageHelper::updateFileFromS3($request->file('image'),$category->image,'images/category');
        }
        $timeNow = now();
        $timeNow = now();
        $data['content'] = $request->content ? $request->content : null;
        $data['updated_at'] = $timeNow;
        $banner->update($data);
    }

    public function deleteBanner($id)
    {
        $bannerId = $this->model->find($id);
        if(File::exists(mb_substr($bannerId->image,strpos($bannerId->image, "_") + 1)))
            {
                File::delete((mb_substr($bannerId->image,strpos($bannerId->image, "_") + 1)));
            }
        return $bannerId->delete($id);
    }
}
