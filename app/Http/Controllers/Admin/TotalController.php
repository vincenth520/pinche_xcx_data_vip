<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\CommentRepositoryEloquent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\CustomerRepositoryEloquent;
use App\Repositories\Eloquent\InfoRepositoryEloquent;
use Illuminate\Support\Facades\DB;

class TotalController extends Controller
{
	public function __construct(CustomerRepositoryEloquent $customerRepositoryEloquent,InfoRepositoryEloquent $infoRepositoryEloquent,CommentRepositoryEloquent $commentRepositoryEloquent)
	{
		$this->customerRepositoryEloquent = $customerRepositoryEloquent;
		$this->infoRepositoryEloquent = $infoRepositoryEloquent;
		$this->commentRepositoryEloquent = $commentRepositoryEloquent;
	}
    public function index()
    {
    	$data['user_total'] = count($this->customerRepositoryEloquent->all());
    	$data['info_total'] = count($this->infoRepositoryEloquent->all());
    	$data['driver_total'] = count($this->customerRepositoryEloquent->findWhere(['driver' => 1]));
    	$data['new_user'] = $this->customerRepositoryEloquent->orderBy('id','desc')->first(['nickName']);
        $data['comment_total'] = $this->commentRepositoryEloquent->getAllCount();
        $data['today_info'] = count(DB::select('select * from infos where to_days(created_at) = to_days(now())'));
        $data['lastday_info'] = count(DB::select('select * from infos where to_days(created_at)+1 = to_days(now())'));
        $data['today_moment'] = count(DB::select('select * from moments where to_days(created_at) = to_days(now())'));
        $data['lastday_moment'] = count(DB::select('select * from moments where to_days(created_at)+1 = to_days(now())'));
    	return responseJson(true,'获取成功',$data);
    }
}
