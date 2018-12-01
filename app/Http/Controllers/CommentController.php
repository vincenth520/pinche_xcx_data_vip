<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\CommentRepositoryEloquent;
use App\Repositories\Eloquent\ZanRepositoryEloquent;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(CommentRepositoryEloquent $commentRepositoryEloquent,ZanRepositoryEloquent $zanRepositoryEloquent)
    {
        $this->commentRepositoryEloquent = $commentRepositoryEloquent;
        $this->zanRepositoryEloquent = $zanRepositoryEloquent;
    }

    public function getCommentCount(Request $request){
        $data = $this->commentRepositoryEloquent->getCount($request->all());
        return responseJson(true,'获取成功',$data);
    }

    public function getCommentList(Request $request){
        return $this->commentRepositoryEloquent->getList($request->all());
    }

    public function addComment(Request $request){
        if ($this->commentRepositoryEloquent->addComment($request->all())){
            return responseJson(true,'评论成功');
        }else{
            return responseJson(false,'评论失败',[],422);
        }
    }

    public function zan(Request $request){
        if ($data = $this->zanRepositoryEloquent->zan($request->all())){
            if(is_array($data)){
                $comment = $this->commentRepositoryEloquent->addZan($request->all());
                return responseJson(true,'点赞成功',$comment['zan']);
            }else{
                $comment = $this->commentRepositoryEloquent->delZan($request->get('comment_id'));
                return responseJson(true,'取消点赞成功',$comment['zan']);
            }
        }else{
            return responseJson(false,'点赞失败',[],422);
        }

    }
}
