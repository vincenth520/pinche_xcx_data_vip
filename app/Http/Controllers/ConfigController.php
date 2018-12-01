<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class ConfigController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['sms_status'] = getConfig('sms_status');

        return responseJson(true,'获取成功',$data);
    }


}