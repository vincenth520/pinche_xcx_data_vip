<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\CustomerRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function __construct(CustomerRepositoryEloquent $customerRepositoryEloquent)
    {
        $this->customerRepositoryEloquent = $customerRepositoryEloquent;
    }

    public function index(Request $request)
    {
        return $this->customerRepositoryEloquent->paginate($request->get('size',10));
    }

    public function getAuthenticationDriver(Request $request){
        return $this->customerRepositoryEloquent->getAuthenticationDriver($request->all());
    }


    public function changeDriverStatus(Request $request){
        if ($this->customerRepositoryEloquent->changeDriverStatus($request->all())){
            return responseJson(true,'审核成功');
        }else{
            return responseJson(false,'审核失败',[],422);
        }
    }

    public function setStatus(Request $request,$id){
        $this->customerRepositoryEloquent->changeStatus($request->all(), $id);
        return responseJson(true,'修改成功');
    }

}
