<?php

namespace App\Presenters;

use App\Repositories\Transformers\SettingTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SettingPresenter
 *
 * @package namespace App\Presenters;
 */
class SettingPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SettingTransformer();
    }
}
