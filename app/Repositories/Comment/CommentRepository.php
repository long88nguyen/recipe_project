<?php

namespace App\Repositories\Comment;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CommentRepository.
 *
 * @package namespace App\Repositories\Comment;
 */
interface CommentRepository extends RepositoryInterface
{
    //

    public function getByPostId($id,$request);

    public function Comment($request,$id);

    public function Reply($request,$id);

    public function DeleteComment($id);

}
