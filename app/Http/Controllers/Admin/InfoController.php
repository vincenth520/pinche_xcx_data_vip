<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\InfoRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    public function __construct(InfoRepositoryEloquent $infoRepositoryEloquent)
    {
        $this->infoRepositoryEloquent = $infoRepositoryEloquent;
    }


    public function index(Request $request){
        return $this->infoRepositoryEloquent->getList($request->get('size',15));
    }

    public function update(Request $request,$id){
        $info = $this->infoRepositoryEloquent->update($request->all(), $id);
        return responseJson(true,'修改成功',$info->toArray());
    }

    public function destroy($id){
        $deleted = $this->infoRepositoryEloquent->delete($id);
        return responseJson(true,'删除成功',$deleted);
    }
}
