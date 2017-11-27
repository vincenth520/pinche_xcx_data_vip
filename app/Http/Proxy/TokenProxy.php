<?php

namespace App\Http\Proxy;

class TokenProxy
{
    protected $http;

    public function __construct(\GuzzleHttp\Client $http)
    {
        $this->http = $http;
    }

    public function login($email,$password)
    {
        if(auth()->attempt(['email' => $email, 'password' => $password , 'is_active' => 1])) {
            return $this->proxy('password',[
                'username' => $email,
                'password' => $password,
                'scope' => ''
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => '邮箱地址或密码错误'
        ],401);
    }

    public function logout(){
        $user = auth()->guard('api')->user();

        if (is_null($user)){
            return responseJson(true,'logout');
        }

        $accessToken = $user->token();
        app('db')->table('oauth_refresh_tokens')
            ->where('access_token_id',$accessToken->id)
            ->update([
                'revoked' => true,
            ]);
        app('cookie')->queue(app('cookie')->forget('refreshToken'));

        $accessToken->revoke();
        return responseJson(true,'logout');
    }

    public function refresh(){
        $refreshToken = request()->cookie('refreshToken');

        return $this->proxy('refresh_token',[
            'refresh_token' => $refreshToken
        ]);
    }

    public function proxy($grantType, array $data = [])
    {
        $data = array_merge($data,[
            'client_id'=> env('PASSPORT_Client_ID'),
            'client_secret'=> env('PASSPORT_Client_Secret'),
            'grant_type'=> $grantType,
        ]);
        $response = $this->http->post(request()->root().'/oauth/token',[
            'form_params' => $data
        ]);

        $token = json_decode((string) $response->getBody(),true);
        return response()->json([
            'token' => $token['access_token'],
            'auth_id' => md5($token['refresh_token']),
            'expires_in' => $token['expires_in']
        ])->cookie('refreshToken', $token['refresh_token'], 864000, null, null, false, true);
    }
}