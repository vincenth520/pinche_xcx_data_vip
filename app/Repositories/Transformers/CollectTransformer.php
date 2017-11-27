<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Collect;

/**
 * Class CollectTransformer
 * @package namespace App\Repositories\Transformers;
 */
class CollectTransformer extends TransformerAbstract
{

    /**
     * Transform the Collect entity
     * @param App\Models\Collect $model
     *
     * @return array
     */
    public function transform(Collect $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
