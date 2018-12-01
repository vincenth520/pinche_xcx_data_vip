<?php

namespace App\Presenters;

use App\Repositories\Transformers\MomentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MomentPresenter
 *
 * @package namespace App\Presenters;
 */
class MomentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MomentTransformer();
    }
}
