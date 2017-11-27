<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\SettingRepositoryEloquent;

class SettingController extends Controller
{
    public function __construct(SettingRepositoryEloquent $settingRepositoryEloquent)
    {
        $this->settingRepositoryEloquent = $settingRepositoryEloquent;
    }

    public function index()
    {
        $data = $this->settingRepositoryEloquent->getAll();
        return responseJson(true,'获取成功',$data);
    }

    public function setSetting(Request $request)
    {
        return $this->settingRepositoryEloquent->saveSetting($request->all());
    }
}
