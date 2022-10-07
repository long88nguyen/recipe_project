<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\File;

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

    public function store($request)
    {
        $data = $request->all();
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/',$filename);
            $data['image']= $filename;
        }
        return $this->model->create($data);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function updateCategory($id,$request)
    {
        $data = $request->all();
        $category = $this->model->findOrFail($id);
        if($request->hasFile('image')) {
            $dest = 'uploads/'.$category->image;
            if(File::exists($dest)) {
                File::delete($dest);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/', $filename);
            $data['image'] = $filename;
        }

        $category->update($data);
        return $data;
    }

    public function delete($id)
    {
        $categoryId = $this->model->findOrFail($id);
        $dest = 'uploads/'.$categoryId->image;
        if(File::exists($dest)) {
            File::delete($dest);
        }
        return $categoryId->delete($id);
    }
}
