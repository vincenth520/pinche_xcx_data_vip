<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\InfoRepository;
use App\Models\Info;
use App\Repositories\Validators\InfoValidator;

/**
 * Class InfoRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class InfoRepositoryEloquent extends BaseRepository implements InfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Info::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InfoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getInfo($id){
        return Info::where('infos.id',$id)
                ->leftJoin('customers', 'customers.id', '=', 'infos.user_id')
                ->first($columns = ['infos.*','customers.nickName','customers.avatarUrl']);
    }

    public static function getUserIdByInfo($info_id){
        return Info::find($info_id);
    }

    public function getList($size){
        return Info::leftJoin('customers', 'customers.id', '=', 'infos.user_id')
            ->orderBy('id','desc')
            ->paginate($size,$columns = ['infos.*','customers.nickName','customers.avatarUrl']);
    }


public function getLists($data){
        return Info::where('departure','like','%'.$data['start'].'%')
                ->where('destination','like','%'.$data['over'].'%')
                ->where('leave_time','>',date('Y-m-d H:i:s',time()))                
                ->where('infos.status',1)
                ->where(function ($query) use ($data){
			        $query->where('leave_time','<',$data['date'])->orWhere('infos.mode', '=', "2");
			    })
                ->orderBy('infos.mode','desc')
                ->orderBy('infos.leave_time','asc')
                ->leftJoin('customers', 'customers.id', '=', 'infos.user_id')
                ->paginate(15,$columns = ['infos.*','customers.nickName','customers.avatarUrl']);
    }


    public function addOrUpdateInfo($data){
        $createData = [
            'user_id' => getUserIdBysk($data['sk']),
            'leave_time' => $data['date'].' '.$data['time'],
            'see' => 0
        ];
        unset($data['sk']);
        unset($data['date']);
        unset($data['time']);
        $createData = array_merge($createData,$data);
        if (@$data['id']){
            $info = $this->find($data['id']);
        }else{
            $info = $this->model;
        }
        foreach ($createData as $key=>$item){
            $info->$key = $item;
        }
        if ($info->save()){
            DB::table('customers')->where('id',$createData['user_id'])->update(['name' => $createData['name']]);//将用户姓名改成最后一次发布的姓名
            return $info->id;
        }
    }

    public function getMyCount($data){
        return $this->findWhere(['user_id' => getUserIdBysk($data['sk'])])->count();
    }

    public function getMyList($data){
        return Info::where(['user_id' => getUserIdBysk($data['sk'])])
            ->leftJoin('customers', 'customers.id', '=', 'infos.user_id')
            ->orderBy('infos.leave_time','desc')
            ->paginate(15,$columns = ['infos.*','customers.nickName','customers.avatarUrl']);
    }

    public function deleteInfo($id){
        DB::beginTransaction();
        DB::table('collects')->where('info_id', $id)->delete();
        if ($this->delete($id)){
            DB::commit();
            return true;
        }else{
            DB::rollback();
            return false;
        }
    }
}
