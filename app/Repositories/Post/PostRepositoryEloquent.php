<?php

namespace App\Repositories\Post;

use App\Enums\ErrorType;
use App\Models\Direction;
use App\Models\Ingredient;
use App\Models\Post;
use App\Models\PostImage;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Post\PostRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class PostRepositoryEloquent.
 *
 * @package namespace App\Repositories\Post;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
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
        $dataPost = $this->model              
                    ->leftJoin('ingredients','posts.id','=','ingredients.post_id')
                    ->leftJoin('directions','posts.id','=','directions.post_id')
                    ->leftJoin('favourites','posts.id','=','favourites.post_id')
                    ->leftJoin('post_images','posts.id','=','post_images.post_id')
                    ->leftJoin('rates','posts.id','=','rates.post_id')
                    ->leftJoin('favourites as f','posts.id','=','favourites.post_id')
                    ->with('Ingredients','Directions','PostImage')
                    ->select('posts.*',DB::raw('count(f.id) as number_favourite,round(avg(rates.number_rating),1) as number_rating'))
                    ->groupBy('id','title','content',
                    'category_id','note','nutrition_facts',
                    'time','member_id','status','created_at',
                    'updated_at','deleted_at')
                    ->get();
        return $dataPost;
    }

    public function store($request)
    {
        try{
            DB::beginTransaction();
            $data = $request->all();
            $memberId = Auth::user()->member->id;
            $timeNow = Carbon::now();
            $dataPost = [
                'title' => $data['title'],
                'content' => $data['content'],
                'status' => 1,
                'category_id' => $data['category_id'],
                'member_id' => $memberId,
                'nutrition_facts' => $data['nutrition_facts'] ? $data['nutrition_facts'] != null : $data['nutrition_facts'] = null,
                'note' => $data['note'] ? $data['note'] != null : $data['note'] = null,
                'time' => $data['time'],
                'created_at' => $timeNow,
                'updated_at' => $timeNow,
            ];
            $postSave = $this->model->create($dataPost);
            $arrIngredient = $data['ingredient_list'];
            foreach ($arrIngredient as $key => $item)
            {
                    $dataIngredient  = [
                        'post_id' => $postSave->id,
                        'name' => $item,
                        'created_at' => $timeNow,
                        'updated_at'=> $timeNow,
                    ];
                    Ingredient::insert($dataIngredient);
            }
    
           $arrDirection = $data['direction_list'];
           foreach ($arrDirection as $key => $item)
            {
                    $dataDirection  = [
                        'post_id' => $postSave->id,
                        "step" => $key,
                        'description' => $item,
                        'created_at' => $timeNow,
                        'updated_at'=> $timeNow,
                    ];
                    Direction::insert($dataDirection);
            }
    
            $arrImage = $data['image_list'];
            foreach ($arrImage as $key => $item)
            {
                    $dataImage  = [
                        'post_id' => $postSave->id,
                        'image' => $item,
                        'created_at' => $timeNow,
                        'updated_at'=> $timeNow,
                    ];
                    PostImage::insert($dataImage);
            }

            DB::commit();

            return ['success' => true];
        }
        catch(Exception $e)
        {
            DB::rollBack();

            return [
                'success' => false,
                'code' => ErrorType::CODE_5000,
                'status_code' => ErrorType::STATUS_500,
                'message' => $e->getMessage()
            ];
        }
    }
}