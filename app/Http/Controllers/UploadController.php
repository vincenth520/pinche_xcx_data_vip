<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            $file = Str::random(40).'.png';

            switch (getConfig('storage_set')){
                case 'qiniu':
                    Upload::qiniuUpload($request->file('file'),$file);
                    $path = getConfig('qiniu_file_domain').$file;
                    break;
                default:
                    $path = $request->getSchemeAndHttpHost().'/'.$request->file('file')->move('uploadfiles/',$file);
                    break;
            }
            return response()->json([
                'status' => true,
                'data' => ['path' => $path],
                'message' => '上传成功'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errmsg' => '上传失败,请重试'
            ], 501);
        }
    }
}
