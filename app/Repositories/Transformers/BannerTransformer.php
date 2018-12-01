<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Banner;

/**
 * Class BannerTransformer
 * @package namespace App\Repositories\Transformers;
 */
class BannerTransformer extends TransformerAbstract
{

    /**
     * Transform the Banner entity
     * @param App\Models\Banner $model
     *
     * @return array
     */
    public function transform(Banner $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
