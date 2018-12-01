<?php
/**
 * Created by PhpStorm.
 * User: Vincent
 * Date: 2017/11/6
 * Time: 15:36
 */

namespace App\Models;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;


class Upload
{
    public static function qiniuUpload($filePath,$key){
        $auth = new Auth(getConfig('qiniu_accesskey'),getConfig('qiniu_secretkey'));
        $token = $auth->uploadToken(getConfig('qiniu_bucket'));
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            return $key;
        } else {
            return $err;
        }
    }

}