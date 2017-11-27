<?php

namespace App\Presenters;

use App\Repositories\Transformers\CustomerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SettingPresenter
 *
 * @package namespace App\Presenters;
 */
class CustomerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CustomerTransformer();
    }
}
