<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Comment;

/**
 * Class CommentTransformer
 * @package namespace App\Repositories\Transformers;
 */
class CommentTransformer extends TransformerAbstract
{

    /**
     * Transform the Comment entity
     * @param App\Models\Comment $model
     *
     * @return array
     */
    public function transform(Comment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
