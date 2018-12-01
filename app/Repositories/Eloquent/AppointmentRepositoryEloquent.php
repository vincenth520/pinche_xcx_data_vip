<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AppointmentRepository;
use App\Models\Appointment;
use App\Repositories\Validators\AppointmentValidator;

/**
 * Class AppointmentRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class AppointmentRepositoryEloquent extends BaseRepository implements AppointmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Appointment::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AppointmentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function addAppointment($data){
        $newData = [
            'user_id' => getUserIdBysk($data['sk']),
            'info_id' => $data['info_id'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'surplus' => $data['surplus']
        ];
        $appointment = $this->findWhere(['user_id' => getUserIdBysk($data['sk']),'info_id' => $data['info_id']])->toArray();
        if (!empty($appointment)) {
            return responseJson(false,'你已经预约过了');
        }
        $res = $this->create($newData);
        $info = InfoRepositoryEloquent::getUserIdByInfo($data['info_id']);
        MessageRepositoryEloquent::addMessage('notice',$info['user_id'],$newData['user_id'],'预约了您发布的拼车信息,请及时处理 ','/pages/appointment/index?id='.$res['id']);

        return responseJson(true,'预约成功',$res);
    }

    public function getMyAppointmentCount($data)
    {
        $res = Appointment::where('infos.user_id',getUserIdBysk($data['sk']))
                ->where('appointments.status',0)
                ->leftJoin('infos','infos.id','=','appointments.info_id')
                ->count();
        return responseJson(true,'获取成功',$res);
    }

    public function getMyInfoAppointment($data)
    {
        $res = Appointment::where('infos.user_id',getUserIdBysk($data['sk']))
                ->leftJoin('infos','infos.id','=','appointments.info_id')
                ->orderBy('infos.leave_time','desc')
                ->get(['appointments.*']);
        return responseJson(true,'获取成功',$res);
    }

    public function getMyAppointment($data)
    {
        $res = Appointment::where('appointments.user_id',getUserIdBysk($data['sk']))
                ->leftJoin('infos','infos.id','=','appointments.info_id')
                ->orderBy('infos.leave_time','desc')
                ->get(['infos.id','infos.phone','infos.departure','infos.destination','infos.leave_time','appointments.status']);
        return responseJson(true,'获取成功',$res);
    }

    public function getAppointmentDetail($data)
    {
        $res = Appointment::where('appointments.id',$data['id'])
                ->leftJoin('infos','infos.id','=','appointments.info_id')
                ->first(['infos.id','infos.phone','infos.departure','infos.destination','infos.leave_time','appointments.*']);
        return responseJson(true,'获取成功',$res);
    }

    public function agreeAppointment($data)
    {
        $updateData['status'] = $data['type'];
        $appointment = Appointment::where('appointments.id',$data['id'])->first();
        $res = Appointment::where('appointments.id',$data['id'])->update($updateData);
        $info = InfoRepositoryEloquent::getUserIdByInfo($appointment['info_id']);
        if ($data['type'] == 1) {
            $message = '同意了您的拼车请求';
        }else{
            $message = '拒绝了您的拼车请求';
        }
        MessageRepositoryEloquent::addMessage('notice',$appointment['user_id'],$info['user_id'],$message,'/pages/appointment/index?id='.$appointment['id']);

        return responseJson(true,'操作成功',$appointment);
    }
}
