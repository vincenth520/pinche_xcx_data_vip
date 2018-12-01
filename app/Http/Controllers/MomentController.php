<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\MomentRepositoryEloquent;
use Illuminate\Http\Request;

class MomentController extends Controller
{

    public function __construct(MomentRepositoryEloquent $momentRepositoryEloquent)
    {
        $this->momentRepositoryEloquent = $momentRepositoryEloquent;
    }

    public function addMoment(Request $request){
        if($this->momentRepositoryEloquent->addMoment($request->all())){
            return responseJson(true,'发布成功');
        }else{
            return responseJson(false,'发布失败');
        }
    }

    public function getMomentsList(Request $request){
        return $this->momentRepositoryEloquent->getMomentsList($request->all());
    }

    public function deleteMoment(Request $request){
        if ($this->momentRepositoryEloquent->deleteMoment($request->all())){
            return responseJson(true,'删除成功');
        }else{
            return responseJson(false,'删除失败');
        }
    }
}
