<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\BannerRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{

    protected $repository;


    public function __construct(BannerRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }


    public function index(Request $request)
    {
        return $this->repository->paginate($request->get('size',10));
    }

    public function store(Request $request){
        $banner = $this->repository->create($request->all());
        return responseJson(true,'新增成功',$banner->toArray());
    }

    public function update(Request $request,$id){
        $banner = $this->repository->update($request->all(), $id);
        return responseJson(true,'修改成功',$banner->toArray());
    }

    public function destroy($id){
        $deleted = $this->repository->delete($id);
        return responseJson(true,'删除成功',$deleted);
    }
}
