<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\CollectRepositoryEloquent;
use Illuminate\Http\Request;

class CollectsController extends Controller
{

    public function __construct(CollectRepositoryEloquent $collectRepositoryEloquent)
    {
        $this->collectRepositoryEloquent = $collectRepositoryEloquent;
    }

    public function addCollect(Request $request){
        $collect = $this->collectRepositoryEloquent->addCollect($request->all());
        if ($collect){
            return responseJson(true,'收藏成功',$collect['id']);
        }else{
            return responseJson(false,'收藏失败',[],422);
        }
    }

    public function deleteCollect(Request $request){
        if($this->collectRepositoryEloquent->deleteCollect($request->get('id'))){
            return responseJson(true,'取消收藏成功');
        }else{
            return responseJson(false,'取消收藏失败',[],422);
        }
    }

    //判断是否已经收藏
    public function isCollect(Request $request){
        if (!empty($collect = $this->collectRepositoryEloquent->isCollect($request->all()))){
            $data = $collect['id'];
        }else{
            $data = 0;
        }

        return responseJson(true,'获取成功',$data);
    }

    public function getMyCollect(Request $request){
        return $this->collectRepositoryEloquent->getMyCollect($request->all());
    }
}
