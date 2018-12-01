<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Moment extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['user_id','content','img'];

}
