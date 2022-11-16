<?php

namespace App\Repositories\Rate;

use App\Enums\ErrorType;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Rate\RateRepository;
use App\Models\Post;
use App\Models\Rate;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Validators\Rate\RateValidator;

/**
 * Class RateRepositoryEloquent.
 *
 * @package namespace App\Repositories\Rate;
 */
class RateRepositoryEloquent extends BaseRepository implements RateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rate::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function ratePost($request , $id)
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

            $checkRate = Rate::where('member_id', $memberId)->where('post_id',$id)->first();
            if($checkRate)
            {
                return [
                    'success' => false,
                    'code' => ErrorType::CODE_5000,
                    'status_code' => ErrorType::STATUS_500,
                    'message' => 'Bài đăng này đã được đánh giá'
                ];
            }

            $timeNow = Carbon::now();
            $dataRate = [
                'post_id' => $id,
                'member_id' => $memberId,
                'number_rating' =>$request['number_rating'],
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
}