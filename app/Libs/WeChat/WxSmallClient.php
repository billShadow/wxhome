<?php
/**
 * 微信小程序接口类
 *  app id    wx51fa2f9eabf66605
 *  secert:   1d3e10ce3ea7da269e10f7805564d2c9
 */

namespace App\Libs\WeChat;

use Ixudra\Curl\Facades\Curl;

class WxSmallClient {
    private static $WX_URL    = 'https://api.weixin.qq.com';
    // 麦当劳的
    private static $WX_APP_ID = 'wxe7985a3d339996c5';
    private static $WX_SECRET = '20f3ace9cdb7d5ee9cc0b9fd9f6e1f57';

    //测试 荣泰的appk
    //private static $WX_APP_ID = 'wx51fa2f9eabf66605';
    //private static $WX_SECRET = '6ec8a712aae0b987a55d42f27a9b4467';

    public static function getSessionKey($code)
    {
        if (empty($code)) {
            return false;
        }
        return Curl::to( self::$WX_URL . '/sns/jscode2session')
            ->withData([
                'appid'      => self::$WX_APP_ID,
                'secret'     => self::$WX_SECRET,
                'js_code'    => $code,
                'grant_type' => 'authorization_code'
            ])
            ->get();
    }

    /**
     * 根据session_key解密用户数据
     */
    public static function decryptData($session_key, $iv, $datas)
    {
        include_once "wxBizDataCrypt.php";
        $pc = new \WXBizDataCrypt(self::$WX_APP_ID, $session_key);

        $rs = $pc->decryptData( $datas, $iv, $data );
        if ($rs == 0) {
            return $data;
        } else {
            return $rs;
        }
    }
}