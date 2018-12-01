<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Setting;

/**
 * Class SettingTransformer
 * @package namespace App\Repositories\Transformers;
 */
class SettingTransformer extends TransformerAbstract
{

    /**
     * Transform the Setting entity
     * @param App\Models\Setting $model
     *
     * @return array
     */
    public function transform(Setting $model)
    {
        return [
            'key'         => $model->key,
            'value'       => $model->value
        ];
    }
}
