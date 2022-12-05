<?php

namespace App\Repositories\Category;

use App\Enums\Constant;
use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

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

    public function getAll($request)
    {
        $perPage = $request->input('per_page', 5);
        $sortColumn = $request->input('sort_column', Constant::DEFAULT_SORT_COLUMN_RESPONSE);
        $sortBy = $request->input('sort_by', Constant::DEFAULT_SORT_BY_RESPONSE);
        $getCategory = $this->model->orderBy( $sortColumn,$sortBy);
        if(isset($request->name))
        {
            $getCategory->where('name', 'like', '%' . $request->name . '%');
        }
        $getCategory =  $getCategory->paginate($perPage);
        return [
            'listCategory' =>  $getCategory
        ];
    }

    public function store($request)
    {
        $timeNow = now();
        $data = [];
        if ($request->file('image')) {
            $image = $request->file('image');
            $destinationPath = public_path('uploads/category');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }
        $data['name'] = $request->name;
        $data['created_at'] = $timeNow;
        $data['updated_at'] = $timeNow;
        return $this->model->create($data);
    }

    public function show($id)
    {
        $getCategoryById = $this->model->find($id);
        return [
            "getCategoryById" => $getCategoryById
        ];
    }

    public function updateCategory($id,$request)
    {
        $category = $this->model->findOrFail($id);
        if ($request->file('image'))
        {
            if(File::exists("uploads/category/".$category->image))
            {
                File::delete("uploads/category/".$category->image);
            }
            $image = $request->file('image');
            $destinationPath = public_path('uploads/category');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }
        $timeNow = now();
        $timeNow = now();
        $data['name'] = $request->name;
        $data['updated_at'] = $timeNow;
        $category->update($data);
    //     return $data;
    }

    public function delete($id)
    {
        $categoryId = $this->model->find($id);
        if(File::exists("uploads/category/".$categoryId->image))
        {
            File::delete("uploads/category/".$categoryId->image);
        }
        return $categoryId->delete($id);
    }
}
