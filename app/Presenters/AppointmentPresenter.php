<?php

namespace App\Presenters;

use App\Repositories\Transformers\AppointmentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AppointmentPresenter
 *
 * @package namespace App\Presenters;
 */
class AppointmentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AppointmentTransformer();
    }
}
