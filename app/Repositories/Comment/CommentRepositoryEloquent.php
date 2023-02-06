<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Comment\CommentRepository;
use App\Validators\Comment\CommentValidator;

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
    
    public function getByPostId($id){
        $getCommentbyPost = $this->model->with('replies:id,parent_id,comment,member_id','member:id,avatar','replies.member:id,avatar')->orderBy('id','DESC')->where('post_id',$id)->whereNull('parent_id')->get();

        return [
            'getCommentbyPost' => $getCommentbyPost
        ];
    }

    public function Comment($request,$id){
        $data['member_id'] = Auth::user()->member->id;
        $data['post_id'] = $id;
        $data['comment'] = $request->comment;
        return $this->model->insert($data);
    }

    public function Reply($request,$id){
        $getComment = $this->model->find($id);
        $data['member_id'] = Auth::user()->member->id;
        $data['post_id'] = $getComment->post_id;
        $data['parent_id'] = $id;
        $data['comment'] = $request->comment;
        return $this->model->insert($data);
    }

    public function DeleteComment($id)
    {
        $this->model->find($id)->delete();
        $this->model->where('parent_id',$id)->delete();
    }
}
