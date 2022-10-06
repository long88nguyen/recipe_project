<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Category\CategoryRepository;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Category;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function index()
    {
        return Category::orderBy('id','DESC')->get();
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function updateCategory($id,$data)
    {
        $category = $this->model->find($id);
        $category->update($data);
        return $data;
    }

    public function delete($id)
    {
        $categoryId = $this->model->find($id);
        return $categoryId->delete($id);
    }
}
