<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Driver;

/**
 * Class DriverTransformer
 * @package namespace App\Repositories\Transformers;
 */
class DriverTransformer extends TransformerAbstract
{

    /**
     * Transform the Driver entity
     * @param App\Models\Driver $model
     *
     * @return array
     */
    public function transform(Driver $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
