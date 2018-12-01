<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\DriverRepositoryEloquent;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function __construct(DriverRepositoryEloquent $driverRepositoryEloquent)
    {
        $this->driverRepositoryEloquent = $driverRepositoryEloquent;
    }

    public function authentication(Request $request){
        if ($this->driverRepositoryEloquent->authentication($request->all())){
            return responseJson(true,'提交成功');
        }
        return responseJson(false,'提交失败',[],422);
    }

    public function getAuthentication(Request $request){
        $data = $this->driverRepositoryEloquent->getAuthentication($request->all());
        return responseJson(true,'获取认证信息成功',$data);
    }
}
