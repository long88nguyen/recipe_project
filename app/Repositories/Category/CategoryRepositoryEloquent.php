<?php

namespace App\Repositories\Category;

use App\Enums\Constant;
use App\Models\Category;
use App\Models\Favourite;
use App\Models\Post;
use App\Models\Rate;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ImageHelper;
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
        // dd(Storage::disk('s3')->exists('images/1673929515.png'));
        $perPage = $request->input('per_page', 5);
        $sortColumn = $request->input('sort_column', Constant::DEFAULT_SORT_COLUMN_RESPONSE);
        $sortBy = $request->input('sort_by', Constant::DEFAULT_SORT_BY_RESPONSE);
        $getCategory = $this->model->orderBy( $sortColumn,$sortBy);
        if(isset($request->name))
        {
            $getCategory->where('name', 'like', '%' . $request->name . '%');
        }
        $getAllcategory =  $getCategory->get();

        // foreach($getAllcategory as $item)
        // {
        //     $item->image = ImageHelper::getS3FileUrl($item->image);
        // }
        $getCategory =  $getCategory->paginate($perPage);
        // foreach($getCategory as $category)
        // {
        //     $category->image = ImageHelper::getS3FileUrl($category->image);
        // }
        return [
            'listCategory' =>  $getCategory,
            'getAllcategory' => $getAllcategory
        ];
    }

    public function store($request)
    {
        $timeNow = now();
        $data = [];
        // $file = $request->file('image');
        // $path = 'images/category';
        // if ($file) {
            
        //     $extension  = $file->getClientOriginalExtension(); 
        //     $image_name = time() .  '.' . $extension;
        //     $urlPath = $path . '/' .$image_name;
        //     Storage::disk('s3')->putFileAs($path, $file, $image_name);
            
        //     // $image = $request->file('image');
        //     // $imageName = time().'.'.$request->image->extension();  
     
        //     // $path = Storage::disk('s3')->put('images', $request->image);
        //     // $path = Storage::disk('s3')->url($path);

      
        // }
        if($request->file('image'))
        {
            $image = $request->file('image');
            $destinationPath = public_path('uploads/category');
            $profileImage = '/uploads/category/' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = $profileImage;
            // $data['image'] = ImageHelper::uploadFileToS3($request->file('image'),'images/category');
        }
        $data['name'] = $request->name;
        $data['created_at'] = $timeNow;
        $data['updated_at'] = $timeNow;
        return $this->model->create($data);
    }

    public function show($id)
    {
        $getCategoryById = $this->model->find($id);
        // $getCategoryById->image = ImageHelper::getS3FileUrl($getCategoryById->image);
        return [
            "getCategoryById" => $getCategoryById
        ];
    }

    public function updateCategory($id,$request)
    {
        $category = $this->model->findOrFail($id);
        if ($request->file('image'))
        {
            if(File::exists(mb_substr($category->image,strpos($category->image, "_") + 1)))
            {
                File::delete(mb_substr($category->image,strpos($category->image, "_") + 1));
            }
            $image = $request->file('image');
            $destinationPath = public_path('uploads/category');
            $profileImage = '/uploads/category/' . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = $profileImage;
            // $data['image'] = ImageHelper::updateFileFromS3($request->file('image'),$category->image,'images/category');
        }
        $timeNow = now();
        $timeNow = now();
        $data['name'] = $request->name;
        $data['updated_at'] = $timeNow;
        $category->update($data);
    }

    public function delete($id)
    {
        $this->deletePost($id);
        $categoryId = $this->model->find($id);
        Post::where('category_id',$id)->delete();
        // dd(File::exists(mb_substr($categoryId->image,strpos($categoryId->image, "_") + 1)));
        if(File::exists(mb_substr($categoryId->image,strpos($categoryId->image, "_") + 1)))
            {
                File::delete((mb_substr($categoryId->image,strpos($categoryId->image, "_") + 1)));
            }
        // ImageHelper::deleteFileFromS3($categoryId->image);
        return $categoryId->delete($id);
    }

    public function getPostByCategory($request)
    {
        $memberId =  Auth::user()->member->id;
        $getCategoryPost = $this->model
        // ->rightjoin('posts','posts.category_id','categories.id')
        // ->where('posts.status',2)
        ->with("Posts.PostImage:id,post_id,image","Posts:id,category_id,status")->get();
        
        
        foreach($getCategoryPost as $value)
        {
            foreach($value['Posts'] as $item)
            {

                $item->rateable = Favourite::where("member_id",$memberId)->where("post_id",$item->id)->first() ? true : false;;
            }
        }
        return [
            "getCategoryPost" => $getCategoryPost,
        ];
    }

    public function deletePost($value)
    {
        $listPostId = Post::where('category_id',$value)->select('id')->get()->toArray();
        DB::table('posts')->whereIn('id', $listPostId)->delete();
        DB::table('ingredients')->whereIn('post_id', $listPostId)->delete();
        DB::table('directions')->whereIn('post_id', $listPostId)->delete();
        DB::table('rates')->whereIn('post_id', $listPostId)->delete();
        DB::table('favourites')->whereIn('post_id', $listPostId)->delete();
        $listPost = DB::table('post_images')->whereIn('post_id', $listPostId)->get();
        foreach($listPost as $item)
        {
            if(File::exists(mb_substr($item->image,strpos($item->image, "_") + 1)))
            {
                File::delete((mb_substr($item->image,strpos($item->image, "_") + 1)));
            }
        }

        DB::table('post_images')->whereIn('post_id', $listPostId)->delete();

    }
}
