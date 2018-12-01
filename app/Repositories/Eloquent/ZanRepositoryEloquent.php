<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ZanRepository;
use App\Models\Zan;
use App\Repositories\Validators\ZanValidator;

/**
 * Class ZanRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class ZanRepositoryEloquent extends BaseRepository implements ZanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Zan::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function zan($data){
        $createData = [
            'user_id' => getUserIdBysk($data['sk']),
            'comment_id' => $data['comment_id']
        ];

        $zan = $this->findWhere($createData)->toArray();
        if (!empty($zan)){
            return $this->deleteWhere($createData);
        }else{
            return $this->create($createData)->toArray();
        }
    }
}
