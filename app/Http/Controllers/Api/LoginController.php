<?php

namespace App\Http\Controllers\Api;

use App\Libs\WeChat\WxSmallClient;
use App\Models\users;
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
        $is_sign = users::where('openid', $array_user->openid)->first();
        if ($is_sign) {
            fun_respon(1, '注册成功!');
        } else {
            // 查询到
            if ( property_exists($array_user, 'session_key')) {
                $userDatas = $wechatclass->decryptData($array_user->session_key, $iv, $cryptData);
                $userData = json_decode($userDatas, true);
                $add_data = [
                    'nickname' => $userData['nickName'],
                    'openid' => $userData['openId'],
                    //'unionid' => $userData['unionId'],
                    'unionid' => str_random(10),
                    'gender' => $userData['gender'],
                    'province' => $userData['province'],
                    'city' => $userData['city'],
                    'avatar_url' => $userData['avatarUrl']
                ];
                $res = users::insert($add_data);
                if (!$res) fun_respon(0, '注册失败');
                fun_respon(1, $userData);
            } else {
                fun_respon(0, '解码失败');
            }
        }

    }

}
