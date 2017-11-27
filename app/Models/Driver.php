<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Driver extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['user_id','name','gender','idnumber'  ,'province','city','county','firstgetdate','platenumber','vehicle','color','owner','cargetdate','driverlicense','drivinglicense','idcard1','idcard2'];

}
