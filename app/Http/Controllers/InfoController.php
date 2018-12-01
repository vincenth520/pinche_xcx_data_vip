<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\InfoRepositoryEloquent;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function __construct(InfoRepositoryEloquent $infoRepositoryEloquent)
    {
        $this->infoRepositoryEloquent = $infoRepositoryEloquent;
    }

    public function getInfo(Request $request){
        $info = $this->infoRepositoryEloquent->getInfo($request->get('id'));
        if ($info){
            return responseJson(true,'获取成功',$info);
        }else{
            return responseJson(false,'获取失败',[],422);
        }
    }

    public function getlists(Request $request){
        return $this->infoRepositoryEloquent->getLists($request->all());
    }

    public function addInfo(Request $request){
        $data = $this->infoRepositoryEloquent->addOrUpdateInfo($request->all());
        if ($data){
            return responseJson(true,'发布成功',['info_id' => $data]);
        }else{
            return responseJson(false,'发布失败',[],422);
        }
    }

    public function getMyCount(Request $request){
        $data = $this->infoRepositoryEloquent->getMyCount($request->all());
        return responseJson(true,'获取成功',$data);

    }

    public function getMyList(Request $request){
        return $this->infoRepositoryEloquent->getMyList($request->all());
    }

    public function deleteInfo(Request $request){
        if ($this->infoRepositoryEloquent->deleteInfo($request->get('id'))){
            return responseJson(true,'删除成功');
        }else{
            return responseJson(false,'删除失败',[],422);
        }
    }
}
