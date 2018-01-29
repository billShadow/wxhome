<?php
/**
 * 微信小程序接口类
 *  app id    wx51fa2f9eabf66605
 *  secert:   1d3e10ce3ea7da269e10f7805564d2c9
 */

namespace App\Libs\WeChat;

use Ixudra\Curl\Facades\Curl;

class WxCreateCard {
    private static $WX_URL    = 'https://api.weixin.qq.com';
    private static $WX_APP_ID = 'wx1985bd0909bbc1f9';   // 小程序的appid
    private static $WX_SECRET = '4e274ce907cf7cda0fa79876c3f2f911';  // 小程序的appsecret

//    private static $WX_APP_ID = 'wxe7985a3d339996c5';   // 麦当劳小程序的appid
//    private static $WX_SECRET = '20f3ace9cdb7d5ee9cc0b9fd9f6e1f57';  // 麦当劳小程序的appsecret


    public static function getAccessToken()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.WxCreateCard::$WX_APP_ID.'&secret='.WxCreateCard::$WX_SECRET;
        //$res = fun_curl($url, []);
        $res = Curl::to($url)->get();
        $res = json_decode($res, true);
        if (isset($res['access_token'])) {
            return $res['access_token'];
        }
        fun_respon(0, '获取access_token失败');
    }
}