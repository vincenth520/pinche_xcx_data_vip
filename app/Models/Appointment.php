<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Appointment extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['info_id','user_id','status','phone','name','surplus'];

}
