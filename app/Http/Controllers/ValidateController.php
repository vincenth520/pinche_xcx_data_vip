<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Illuminate\Http\Request;

class ValidateController extends Controller
{
    public function getCode(Request $request){
        return Sms::sendCode($request->get('phone'));
    }


}
