<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Message;

/**
 * Class MessageTransformer
 * @package namespace App\Repositories\Transformers;
 */
class MessageTransformer extends TransformerAbstract
{

    /**
     * Transform the Message entity
     * @param App\Models\Message $model
     *
     * @return array
     */
    public function transform(Message $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
