<?php

namespace App\Presenters;

use App\Repositories\Transformers\InfoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InfoPresenter
 *
 * @package namespace App\Presenters;
 */
class InfoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InfoTransformer();
    }
}
