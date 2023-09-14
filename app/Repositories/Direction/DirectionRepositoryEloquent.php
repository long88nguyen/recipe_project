<?php

namespace App\Repositories\Direction;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Direction\DirectionRepository;
use App\Entities\Direction\Direction;
use App\Validators\Direction\DirectionValidator;

/**
 * Class DirectionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Direction;
 */
class DirectionRepositoryEloquent extends BaseRepository implements DirectionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Direction::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAll($request){
            $listDirection = $this->model->orderBy("id","DESC")->paginate(10);
       return [
            "listDirection" => $listDirection
       ];
    }
    
}
