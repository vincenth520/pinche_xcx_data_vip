<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Validators\CollectValidator;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\DriverRepository;
use App\Models\Driver;
use Dingo\Api\Exception\StoreResourceFailedException;

/**
 * Class DriverRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class DriverRepositoryEloquent extends BaseRepository implements DriverRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Driver::class;
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

    public function validate($data)
    {
        $rules = [
            'name' => 'required',
            'idnumber'  => 'required|min:15',
            'province'=> 'required',
            'city'=> 'required',
            'county'=> 'required',
            'firstgetdate'=> 'required|date',
            'platenumber'=> 'required|min:4',
            'vehicle'=> 'required',
            'color'=> 'required',
            'owner'=> 'required',
            'cargetdate'=> 'required',
            'driverlicense'=> 'required',
            'drivinglicense'=> 'required',
            'idcard1'=> 'required',
            'idcard2'=> 'required'
        ];

        $name = [
            'name' => '姓名',
            'idnumber'  => '身份证号',
            'province'=> '城市',
            'city'=> '城市',
            'county'=> '城市',
            'firstgetdate'=> '驾照领取日期',
            'platenumber'=> '车牌号',
            'vehicle'=> '车型',
            'color'=> '颜色',
            'owner'=> '车辆所有人',
            'cargetdate'=> '车辆注册日期',
            'driverlicense'=> '驾照照片',
            'drivinglicense'=> '行驶证照片',
            'idcard1'=> '身份证照片正面',
            'idcard2'=> '身份证照片反面'
        ];

        $validator = app('validator')->make($data, $rules,[],$name);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Please check your input.', $validator->errors());
        }
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAuthentication($data){
        return $this->getDriverByUserId(getUserIdBysk($data['sk']));
    }



    public function authentication($data){
        $this->validate($data);
        $createData = [
            'user_id' => getUserIdBysk($data['sk']),
            'name' => $data['name'],
            'gender' => $data['gender'],
            'idnumber' => $data['idnumber'],
            'province' => $data['province'],
            'city' => $data['city'],
            'county' => $data['county'],
            'firstgetdate' => $data['firstgetdate'],
            'platenumber' => $data['platenumber'],
            'vehicle' => $data['vehicle'],
            'color' => $data['color'],
            'owner' => $data['owner'],
            'cargetdate' => $data['cargetdate'],
            'driverlicense' => $data['driverlicense'],
            'drivinglicense' => $data['drivinglicense'],
            'idcard1' => $data['idcard1'],
            'idcard2' => $data['idcard2'],
        ];
        DB::beginTransaction();
        try{
            $this->deleteWhere(['user_id' => getUserIdBysk($data['sk'])]);
            $this->create($createData);
            $driverData['driver'] = 2;
            $driverData['vehicle'] = $data['vehicle'];
            DB::table('customers')->where('id',getUserIdBysk($data['sk']))->update($driverData);
            DB::commit();
            return true;
        }catch(Excpetion $e){
            DB::rollBack();
            return false;
        }
    }


    public function getDriverByUserId($userId){
        return Driver::where('user_id',$userId)->first();
    }
}
