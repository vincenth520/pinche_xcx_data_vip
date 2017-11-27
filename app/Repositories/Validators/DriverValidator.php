<?php

namespace App\Repositories\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class DriverValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required',
            'idnumber'  => 'required|min:15',
            'province'=> 'required',
            'city'=> 'required',
            'county'=> 'required',
            'firstgetdate'=> 'required|date',
            'platenumber'=> 'required|min:4',
            'vehicle'=> 'required',
            'color'=> 'required',
            'owner'=> 'required',
            'cargetdate'=> 'required',
            'driverlicense'=> 'required',
            'drivinglicense'=> 'required',
            'idcard1'=> 'required',
            'idcard2'=> 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];
}
