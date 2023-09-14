<?php

namespace App\Repositories\Favourite;

use App\Enums\ErrorType;
use App\Models\Favourite;
use App\Models\Post;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Favourite\FavouriteRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class FavouriteRepositoryEloquent.
 *
 * @package namespace App\Repositories\Favourite;
 */
class FavouriteRepositoryEloquent extends BaseRepository implements FavouriteRepository
{
    /**
     * Specify Model class name
    *
     * @return string
     */
    public function model()
    {
        return Favourite::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function favouritePost($id)
    {
        try{
            DB::beginTransaction();
            $memberId = Auth::user()->member->id;
            $timeNow = Carbon::now();

            $checkPost = Post::where('id',$id)->first();
            if(!$checkPost)
            {
                return [
                    'success' => false,
                    'code' => ErrorType::CODE_5000,
                    'status_code' => ErrorType::STATUS_500,
                    'message' => 'Bài đăng này không tồn tại tồn tại'
                ];
            }

            $checkFavourite = Favourite::where('member_id', $memberId)->where('post_id',$id)->first();
            if($checkFavourite)
            {
                return [
                    'success' => false,
                    'code' => ErrorType::CODE_5000,
                    'status_code' => ErrorType::STATUS_500,
                    'message' => 'Bài đăng này đã được yêu thích'
                ];
            }

            $timeNow = Carbon::now();
            $dataRate = [
                'post_id' => $id,
                'member_id' => $memberId,
                'created_at' => $timeNow,
                'updated_at' => $timeNow,
            ];
            $this->model->create($dataRate);

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

    public function unfavouritePost($id)
    {
        try{
            DB::beginTransaction();
            $memberId = Auth::user()->member->id;

            $checkPost = Post::where('id',$id)->first();
            if(!$checkPost)
            {
                return [
                    'success' => false,
                    'code' => ErrorType::CODE_5000,
                    'status_code' => ErrorType::STATUS_500,
                    'message' => 'Bài đăng này không tồn tại tồn tại'
                ];
            }

            $checkFavourite = Favourite::where('member_id', $memberId)->where('post_id',$id)->first();
            if(!$checkFavourite)
            {
                return [
                    'success' => false,
                    'code' => ErrorType::CODE_5000,
                    'status_code' => ErrorType::STATUS_500,
                    'message' => 'Bài đăng này chu được yêu thích'
                ];
            } 

            $this->model->where('member_id',$memberId)->where('post_id',$id)->delete();

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
