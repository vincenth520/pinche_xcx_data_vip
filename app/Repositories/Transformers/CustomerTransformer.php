<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Customer;

/**
 * Class SettingTransformer
 * @package namespace App\Repositories\Transformers;
 */
class CustomerTransformer extends TransformerAbstract
{

    /**
     * Transform the Setting entity
     * @param App\Models\Customer $model
     *
     * @return array
     */
    public function transform(Customer $model)
    {
        return [
            'id'         =>  $model->id,
            'avatarUrl'  =>  $model->avatarUrl,
            'city'       =>  $model->city,
            'country'    =>  $model->country,
            'gender'     =>  $model->gender,
            'language'   =>  $model->language,
            'nickName'   =>  $model->nickName,
            'province'   =>  $model->province,
            'county'     =>  $model->county,
            'phone'      =>  $model->phone,
            'vehicle'    =>  $model->vehicle,
            'name'       =>  $model->name,
            'driver'     =>  $model->driver,
            'status'     =>  $model->status,

        ];
    }
}