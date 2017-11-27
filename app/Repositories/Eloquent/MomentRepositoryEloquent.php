<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\MomentRepository;
use App\Models\Moment;
use App\Repositories\Validators\MomentValidator;

/**
 * Class MomentRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class MomentRepositoryEloquent extends BaseRepository implements MomentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Moment::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MomentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function addMoment($data){
        $createData = [
            'user_id' => getUserIdBysk($data['sk']),
            'content' => $data['content'],
            'img'     => $data['img']
        ];
        return $this->create($createData);
    }

    public function  getMomentsList($data){
        $where = [];
        if (@$data['user'] == 'my'){
            $where['user_id'] = getUserIdBysk($data['sk']);
        }
        return Moment::where($where)
                    ->leftJoin('customers', 'customers.id', '=', 'moments.user_id')
                    ->paginate(15,$columns = ['customers.nickName','customers.avatarUrl','moments.content','moments.updated_at','moments.id','moments.img']);
    }

    public static function getUserIdByInfo($info_id){
        return Moment::find($info_id);
    }

    public function deleteMoment($data){
        $where = [
            'user_id' => getUserIdBysk($data['sk']),
            'id'      => $data['id']
        ];
        return Moment::where($where)->delete();
    }
}
