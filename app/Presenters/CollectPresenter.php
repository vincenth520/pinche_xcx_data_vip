<?php

namespace App\Presenters;

use App\Repositories\Transformers\CollectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CollectPresenter
 *
 * @package namespace App\Presenters;
 */
class CollectPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CollectTransformer();
    }
}
