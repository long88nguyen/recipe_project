<?php

namespace App\Repositories\Rate;

use App\Enums\ErrorType;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Rate\RateRepository;
use App\Models\Post;
use App\Models\Rate;
use Carbon\Carbon;
use FormatHelper;
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
    
    public function ratePost($request,$id)
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
                'number_rating' => $request['number_rating'],
                'review' => $request['review'] ? $request['review'] : null,
                'created_at' => $timeNow,
                'updated_at' => $timeNow,
            ];
            $ok = $this->model->create($dataRate);
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

    public function listRate($id)
    {
        $getRateByPost = $this->model->where("post_id",$id)->with("member")->orderBy('id','DESC')->get();
        return [
            "getRateByPost" => $getRateByPost
        ];
        
    }

    public function getAll($request)
    {
        $getAll = $this->model->orderBy('id','DESC')->with("member:id,name","post:id,title");
        if ($request->has('post_title') && $request->post_title)
        {
            $getAll->whereHas("post",function($query) use($request){
                $query->where('posts.title', 'LIKE', '%' . FormatHelper::escape_like($request->post_title) . '%');
            });
        }

        if ($request->has('member_name') && $request->member_name)
        {
            $getAll->whereHas("member",function($query) use($request){
                $query->where('members.name', 'LIKE', '%' . FormatHelper::escape_like($request->member_name) . '%');
            });
        }
        
        
        $getAll = $getAll->paginate(10);
        return [
            "getAll" => $getAll
        ];
        
    }

    public function detail($id){
        $memberId = Auth::user()->member->id;
        $getRateDetail = $this->model->where("id",$id)->where("member_id",$memberId)->first();
        return [
            "getRateDetail" => $getRateDetail
        ];
    }

    public function updateRate($request,$id)
    {
        $rateId = $this->model->find($id);
        $dataUpdate = [
            "number_rating" => $request['number_rating'],
            "review" => $request['review'] ? $request['review'] : null,
        ];
        return $rateId->update($dataUpdate);
    }
    
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function StatRate($id){
        $rateRange = [1, 2, 3, 4, 5];
        $rateStat = $this->model->where('post_id',$id)
                    ->select("number_rating",DB::raw('count(rates.number_rating) as count_star'))
                    ->groupBy('number_rating')
                    ->get()
                    ->pluck("count_star","number_rating");
        $totalReview = $this->model->where('post_id',$id)->count();
        $dataStar = [];
        foreach ($rateRange as $item) {
            $dataStar[$item] = $rateStat->get($item, 0);
        }
        return [
           'dataStar' => $dataStar,
           'totalReview' => $totalReview,
        ];

    }
}
