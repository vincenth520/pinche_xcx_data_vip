<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\SettingRepository;
use App\Models\Setting;
use App\Repositories\Validators\SettingValidator;

/**
 * Class SettingRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class SettingRepositoryEloquent extends BaseRepository implements SettingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Setting::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SettingValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getItem($key){

        $data = $this->findByField('key',$key);

        if (!empty($data)){
            return $data;
        }

        return false;

    }

    public static function getValue($key)
    {
        $result = Setting::where(['key' => $key])->first();
        return $result['value'];
    }

    public function getValueId($key)
    {
        if ($data = $this->getItem($key)){
            return $data['id'];
        }

        return false;
    }

    public function getAll()
    {
        $this->setPresenter("App\\Presenters\\SettingPresenter");
        return collect($this->all())->map(function ($item){
            return collect($item)->pluck('value','key');
        });
    }

    public function saveSetting($data)
    {
        $newData = [];
        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $newData[$key]['key'] = $key;
                $newData[$key]['value'] = $value;
            }
        }
        DB::beginTransaction();
        try{
            DB::table('settings')->delete();
            DB::table('settings')->insert($newData);
            DB::commit();
            return response()->json(['status' => 'success','message' => '设置成功']);
        }catch (QueryException $ex) {
            DB::rollBack();
            return response()->json(['status' => 'error','message' => '请求超时,请重试']);
        }
    }
}
