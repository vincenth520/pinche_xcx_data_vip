<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function rules()
    {
        return [
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
        ];
    }


    public function reset(Request $request)
    {
        if(Hash::check($request->get('old_password'),$request->user()->password)){
            $response = $request->user()->fill([
                'password' => Hash::make($request->get('new_password'))
            ])->save();
            return response()->json(['status' => 'success','message' => '密码修改成功']);
        }else{
            return response()->json(['status' => 'error','message' => '原密码输入错误']);
        }

    }
}
