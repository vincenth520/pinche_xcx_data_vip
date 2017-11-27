<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Info;

/**
 * Class InfoTransformer
 * @package namespace App\Repositories\Transformers;
 */
class InfoTransformer extends TransformerAbstract
{

    /**
     * Transform the Info entity
     * @param App\Models\Info $model
     *
     * @return array
     */
    public function transform(Info $model)
    {
        return [
        ];
    }
}
