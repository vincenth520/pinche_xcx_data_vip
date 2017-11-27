<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Setting extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'settings';
    protected $fillable = [];

}
