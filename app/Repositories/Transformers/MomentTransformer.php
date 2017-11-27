<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Moment;

/**
 * Class MomentTransformer
 * @package namespace App\Repositories\Transformers;
 */
class MomentTransformer extends TransformerAbstract
{

    /**
     * Transform the Moment entity
     * @param App\Models\Moment $model
     *
     * @return array
     */
    public function transform(Moment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
