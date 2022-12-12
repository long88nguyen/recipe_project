<?php

namespace App\Repositories\PostImage;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PostImage\PostImageRepository;
use App\Entities\PostImage\PostImage;
use App\Validators\PostImage\PostImageValidator;

/**
 * Class PostImageRepositoryEloquent.
 *
 * @package namespace App\Repositories\PostImage;
 */
class PostImageRepositoryEloquent extends BaseRepository implements PostImageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PostImage::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function getAll($request){
        $listPostImage = $this->model->orderBy("id","DESC")->paginate(10);
        return [
                "listPostImage" => $listPostImage
        ];
}
    
    
}
