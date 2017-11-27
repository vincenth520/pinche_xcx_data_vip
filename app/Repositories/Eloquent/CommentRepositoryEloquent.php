<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CommentRepository;
use App\Models\Comment;
use App\Repositories\Validators\CommentValidator;
use App\Repositories\Eloquent\MessageRepositoryEloquent;

/**
 * Class CommentRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
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
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CommentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getCount($data){
        return $this->findWhere(['info_id' => $data['id'],'type' => $data['type']])->count();
    }

    public function getList($data){
        return Comment::where(['info_id' => $data['id'],'type' => $data['type']])
                        ->leftJoin('customers', 'customers.id', '=', 'comments.user_id')
                        ->paginate(15,$columns = ['comments.*','customers.nickName','customers.avatarUrl']);
    }

    public function getCommentById($id){
        return $this->find($id);
    }

    public function addZan($data){
        Comment::where('id',$data['comment_id'])->increment('zan');
        $comment = $this->getCommentById($data['comment_id']);
        MessageRepositoryEloquent::addMessage('zan',$comment['user_id'],getUserIdBysk($data['sk']),'赞了你的评论 :'.$comment['content']);
        return $comment;
    }

    public function delZan($id){
        Comment::where('id',$id)->decrement('zan');
        return $this->getCommentById($id);
    }


    public function addComment($data){
        $createData = [
            'info_id' => $data['info_id'],
            'user_id' => getUserIdBysk($data['sk']),
            'type' => $data['type'],
            'content' => $data['content'],
            'img' => $data['img'],
            'reply' => $data['reply']
        ];
        if ($createData['type'] == 'info'){
            $info = InfoRepositoryEloquent::getUserIdByInfo($data['info_id']);
        }elseif($createData['type'] == 'dynamic'){
            $info = MomentRepositoryEloquent::getUserIdByInfo($data['info_id']);
        }
        MessageRepositoryEloquent::addMessage('comment',$info['user_id'],$createData['user_id'],'评论了您的信息 :'.$data['content'],'/pages/'.$data['type'].'/index?id='.$info['id']);
        return $this->create($createData);
    }


    public function getAllCount(){
        return DB::table('comments')->count();
    }

}
