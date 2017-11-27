<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Appointment;

/**
 * Class AppointmentTransformer
 * @package namespace App\Repositories\Transformers;
 */
class AppointmentTransformer extends TransformerAbstract
{

    /**
     * Transform the Appointment entity
     * @param App\Models\Appointment $model
     *
     * @return array
     */
    public function transform(Appointment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
