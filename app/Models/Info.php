<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Info extends Model implements Transformable
{
    use TransformableTrait;
    protected $fillable = ['user_id','user_id','leave_time','departure','destination','gender','name','phone','remark','surplus','type','vehicle','status','see','price','goods'];

}
