<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CollectRepository;
use App\Models\Collect;
use App\Repositories\Validators\CollectValidator;

/**
 * Class CollectRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class CollectRepositoryEloquent extends BaseRepository implements CollectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Collect::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CollectValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function addCollect($data){
        $createData = [
            'info_id' => $data['info_id'],
            'user_id' => getUserIdBysk($data['sk'])
        ];
        return $this->create($createData);
    }

    public function deleteCollect($id){
        return $this->delete($id);
    }

    public function isCollect($data){
        return Collect::Where([
            'info_id'=>$data['info_id'],
            'user_id' => getUserIdBysk($data['sk'])
        ])->first();
    }

    public function getMyCollect($data){
        return Collect::Where([
                'collects.user_id' => getUserIdBysk($data['sk'])
            ])
            ->leftJoin('infos', 'collects.info_id', '=', 'infos.id')
            ->paginate(15,$columns = ['infos.*','collects.id as fad']);
    }
}
