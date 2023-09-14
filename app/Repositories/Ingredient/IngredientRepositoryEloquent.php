<?php

namespace App\Repositories\Ingredient;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Ingredient\IngredientRepository;
use App\Entities\Ingredient\Ingredient;
use App\Validators\Ingredient\IngredientValidator;

/**
 * Class IngredientRepositoryEloquent.
 *
 * @package namespace App\Repositories\Ingredient;
 */
class IngredientRepositoryEloquent extends BaseRepository implements IngredientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Ingredient::class;
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
       $listIngredient = $this->model->orderBy("id","DESC")->paginate(10);
       return [
            "listIngredient" => $listIngredient
       ];
    }
}
