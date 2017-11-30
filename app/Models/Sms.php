<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 2017/11/7
 * Time: 12:06
 */

namespace App\Models;


use Aliyun\Core\Config as AliyunConfig;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;
use Illuminate\Support\Facades\Cache;
use Log;

class Sms
{
    public static function sendCode($phone){
        // $c = new TopClient;
        // $c->appkey = getConfig('sms_appkey');
        // $c->secretKey = getConfig('sms_secret');
        // $req = new AlibabaAliqinFcSmsNumSendRequest;
        // $req->setExtend();
        // $req->setSmsType("normal");
        // $req->setSmsFreeSignName(getConfig('sms_FreeSignName'));
        // $code = self::setCode($phone);
        // $req->setSmsParam("{\"name\":\"".$code."\"}");
        // $req->setRecNum($phone);
        // $req->setSmsTemplateCode(getConfig('sms_TemplateCode'));
        // $resp = $c->execute($req);
        // if (@$resp->code){
        //     return response()->json([
        //         'status' => false,
        //         'errmsg' => $resp->sub_msg
        //     ]);
        // }else{
        //     return response()->json([
        //         'status' => true,
        //         'message' => '发送成功'
        //     ]);
        // }

        // 初始化阿里云config
        AliyunConfig::load();
        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile("cn-hangzhou", getConfig('sms_appkey'), getConfig('sms_secret'));
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", "Dysmsapi", "dysmsapi.aliyuncs.com");
        $acsClient = new DefaultAcsClient($profile);
        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        // 必填，设置短信接收号码
        $request->setPhoneNumbers($phone);
        // 必填，设置签名名称
        $request->setSignName(getConfig('sms_FreeSignName'));
        // 必填，设置模板CODE
        $request->setTemplateCode(getConfig('sms_TemplateCode'));

        $code = self::setCode($phone);
        $request->setTemplateParam("{\"code\":\"".$code."\"}");

        $acsResponse =  $acsClient->getAcsResponse($request);
        // 默认返回stdClass，通过返回值的Code属性来判断发送成功与否
        if($acsResponse && strtolower($acsResponse->Code) == 'ok')
        {
            return responseJson(true,'发送成功');
        }
        Log::error('【sms-error】'.$phone.':'.$acsResponse->Code);
        return responseJson(false,$acsResponse->Code,'',422);
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