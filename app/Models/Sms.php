<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 2017/11/7
 * Time: 12:06
 */

namespace App\Models;


use Alidayu\AlibabaAliqinFcSmsNumSendRequest;
use Alidayu\TopClient;
use Illuminate\Support\Facades\Cache;

class Sms
{
    public static function sendCode($phone){
        $c = new TopClient;
        $c->appkey = getConfig('sms_appkey');
        $c->secretKey = getConfig('sms_secret');
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend();
        $req->setSmsType("normal");
        $req->setSmsFreeSignName(getConfig('sms_FreeSignName'));
        $code = self::setCode($phone);
        $req->setSmsParam("{\"name\":\"".$code."\"}");
        $req->setRecNum($phone);
        $req->setSmsTemplateCode(getConfig('sms_TemplateCode'));
        $resp = $c->execute($req);
        if (@$resp->code){
            return response()->json([
                'status' => false,
                'errmsg' => $resp->sub_msg
            ]);
        }else{
            return response()->json([
                'status' => true,
                'message' => '发送成功'
            ]);
        }
    }

    public static function setCode($phone){
        $code = rand(10001,99999);
        Cache::put($phone,$code,1800);
        return $code;
    }

    public static function vaildCode($phone,$code){
        return Cache::get($phone) == $code;
    }



}