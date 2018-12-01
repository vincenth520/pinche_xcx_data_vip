<?php

namespace App\Http\Controllers;


use App\Models\Sms;
use App\Repositories\Eloquent\CustomerRepositoryEloquent;
use Illuminate\Http\Request;

class CustomerController
{
    public function __construct(CustomerRepositoryEloquent $customerRepositoryEloquent)
    {
        $this->customerRepositoryEloquent = $customerRepositoryEloquent;
    }

    public function vaild_sk(Request $request){
        if (vaild_sk($request->get('sk'))){
            return responseJson(true,'验证成功');
        }else{
            return responseJson(false,'登录已过期','',401);
        }
    }

    public function getMyInfo(Request $request){
        return responseJson(true,'获取用户信息成功',getUserBySk($request->get('sk')));
    }

    public function login(Request $request){
        $jscode2session = getOpenid($request->get('code'));

        if (@$jscode2session['errcode']) {
            return response()->json([
                'status' => false,
                'code' => $jscode2session['errcode'],
                'errmsg' => $jscode2session['errmsg']
            ], 401);
        }

        $user = $this->customerRepositoryEloquent->getUserByOpenid($jscode2session['openid']);
        if (empty($user)){
            $userInfo = getUserInfo($jscode2session['session_key'],$request->get('encryptedData'),$request->get('iv'));
            if($userInfo){
                unset($userInfo['watermark']);
                $this->customerRepositoryEloquent->create($userInfo);
            }else{
                return responseJson(false,'获取用户消息失败','',401);
            }
        }

        $user = $this->customerRepositoryEloquent->getUserByOpenid($jscode2session['openid']);
        if ($user['status'] == 0){
            return responseJson(false,'账户被禁用');
        }

        $sk = get3rdSession($jscode2session['openid']);

        return responseJson(true,'登录成功',[
            'sk' => $sk,
            'user' => $user
        ]);
    }

    public function editUser(Request $request){
        if ($request->has('phone') && getConfig('sms_status')){
            if (!Sms::vaildCode($request->get('phone'),$request->get('verification'))){
                return responseJson(false,'验证码错误','',401);
            }
        }
        if($this->customerRepositoryEloquent->updateUser($request->all())){
            $user = $this->customerRepositoryEloquent->getUserByOpenid(vaild_sk($request->get('sk')));
            return responseJson(true,'修改成功',['userInfo' => $user],401);
        }else{
            return responseJson(false,'修改失败','',402);
        }
    }

}