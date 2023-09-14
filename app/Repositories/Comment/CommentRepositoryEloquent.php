<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Comment\CommentRepository;
use App\Validators\Comment\CommentValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace App\Repositories\Comment;
 */
class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    public function getByPostId($id,$request){
        $getCommentbyPost = $this->model
        ->with('replies:id,parent_id,comment,member_id,created_at,updated_at','member:id,avatar,name','replies.member:id,avatar,name')
        ->orderBy('id','DESC')
        ->where('post_id',$id)->whereNull('parent_id')->paginate(5);
        foreach($getCommentbyPost as $item)
        {
            $item->duration = strtotime(Carbon::now()->format("Y-m-d H:i:s")) - strtotime(Carbon::parse($item->created_at)->format("Y-m-d H:i:s")); 
            foreach($item['replies'] as $value){
                $value->duration = strtotime(Carbon::now()->format("Y-m-d H:i:s")) - strtotime(Carbon::parse($value->created_at)->format("Y-m-d H:i:s")); 
            }
        }

        return [
            'getCommentbyPost' => $getCommentbyPost
        ];
    }

    public function Comment($request,$id){
        $data['member_id'] = Auth::user()->member->id;
        $data['post_id'] = $id;
        $data['comment'] = $request->comment;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        return $this->model->insert($data);
    }

    public function Reply($request,$id){
        $getComment = $this->model->find($id);
        $data['member_id'] = Auth::user()->member->id;
        $data['post_id'] = $getComment->post_id;
        $data['parent_id'] = $id;
        $data['comment'] = $request->comment;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        return $this->model->insert($data);
    }

    public function DeleteComment($id)
    {
        $this->model->find($id)->delete();
        $this->model->where('parent_id',$id)->delete();
    }

    public function reportComment($id){
        $checkData = $this->model->find($id);
        $checkData->report +=1;
        return $checkData->save();
    }

    public function reportList(){
        $dataReport = $this->model->select('id','comment','report')->where('report','>','0')->get();
        $countReport = $this->model->where('report','>','0')->count();
        return [
            'dataReport' => $dataReport,
            'countReport' => $countReport,
        ];
    }
}
