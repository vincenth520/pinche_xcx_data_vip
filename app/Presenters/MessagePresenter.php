<?php

namespace App\Presenters;

use App\Repositories\Transformers\MessageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MessagePresenter
 *
 * @package namespace App\Presenters;
 */
class MessagePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MessageTransformer();
    }
}
