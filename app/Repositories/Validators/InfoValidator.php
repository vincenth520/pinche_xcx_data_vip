<?php

namespace App\Repositories\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class InfoValidator extends LaravelValidator
{

//    protected $rules = [
//        ValidatorInterface::RULE_CREATE => [
//            'title' => 'required',
//            'text'  => 'min:3',
//            'author'=> 'required'
//        ],
//        ValidatorInterface::RULE_UPDATE => [
//            'title' => 'required'
//        ]
//    ];

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
