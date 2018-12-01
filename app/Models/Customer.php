<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Customer extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'customers';

    protected $fillable = ['openId','avatarUrl','city', 'country', 'gender', 'language', 'nickName', 'openId', 'province', 'county', 'phone', 'vehicle', 'name'];

}
