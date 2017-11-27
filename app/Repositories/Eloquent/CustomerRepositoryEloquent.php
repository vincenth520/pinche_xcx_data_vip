<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\CustomerRepository;
use App\Models\Customer;
use App\Repositories\Validators\CustomerValidator;

/**
 * Class CustomerRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class CustomerRepositoryEloquent extends BaseRepository implements CustomerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Customer::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getUserByOpenid($openid)
    {
        $this->setPresenter("App\\Presenters\\CustomerPresenter");
        $data = $this->findByField('openId',$openid);
        return @$data['data'][0];
    }

    public function updateUser($data){
        $user = $this->getUserByOpenid(vaild_sk($data['sk']));
        return $this->update($data,$user['id']);
    }


    public static function getUserBysk($sk){
        return Customer::where('openId',vaild_sk($sk))->first();
    }

    public function getAuthenticationDriver($data){
        return Customer::where('driver',2)->paginate($data['size']);
    }


    public function changeDriverStatus($data){
        $driverSattus['driver'] = $data['driver'];
        return Customer::where('id',$data['user_id'])->update($driverSattus);
    }
    public function changeStatus($data,$id){
        $status['status'] = $data['status'];
        return Customer::where('id',$id)->update($status);
    }

}
