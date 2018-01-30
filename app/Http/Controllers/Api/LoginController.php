<?php

namespace App\Http\Controllers\Api;

use App\Libs\WeChat\WxSmallClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $code = $request->json('code');
        $iv = $request->json('iv');
        $cryptData = $request->json('cryptData');

        if (empty($code) || empty($iv) || empty($cryptData)) {
            fun_respon(0, '缺少参数');
        }
        $wechatclass = new WxSmallClient();
        $rs = $wechatclass->getSessionKey($code);
        $array_user = json_decode($rs);
        if (!is_object($array_user)) {
            fun_respon(0, '网络异常请重试');
        }
        if ( property_exists($array_user, 'session_key')) {
            $userDatas = $wechatclass->decryptData($array_user->session_key, $iv, $cryptData);
            $userData = json_decode($userDatas, true);
            fun_respon(1, $userData);
        } else {
            var_dump($array_user);
            fun_respon(0, '解码失败');
        }
    }

}
