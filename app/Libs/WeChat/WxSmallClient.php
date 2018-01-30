<?php
/**
 * 微信小程序接口类
 *  app id    wx51fa2f9eabf66605
 *  secert:   1d3e10ce3ea7da269e10f7805564d2c9
 */

namespace App\Libs\WeChat;

use Ixudra\Curl\Facades\Curl;

class WxSmallClient {
    public $WX_URL    = 'https://api.weixin.qq.com';
    private $WX_APP_ID = '';
    private $WX_SECRET = '';

    public function __construct()
    {
        $this->WX_APP_ID = env('XCX_APP_ID');
        $this->WX_SECRET = env('XCX_SECRET');
    }

    public function getSessionKey($code)
    {
        if (empty($code)) {
            return false;
        }
        $url = $this->WX_URL . '/sns/jscode2session?appid='.$this->WX_APP_ID.'&secret='.$this->WX_SECRET
.'&js_code='.$code.'&grant_type=authorization_code';
        $res = $this->fun_curl($url);
        return $res;
    }

    /**
     * 根据session_key解密用户数据
     */
    public function decryptData($session_key, $iv, $datas)
    {
        include_once "wxBizDataCrypt.php";
        $pc = new \WXBizDataCrypt($this->WX_APP_ID, $session_key);

        $rs = $pc->decryptData( $datas, $iv, $data );
        if ($rs == 0) {
            return $data;
        } else {
            return $rs;
        }
    }

    public function fun_curl($url){
        $ch = curl_init();
        //print_r($ch);
        curl_setopt( $ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); //设置超时
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        $return = curl_exec ( $ch );
        curl_close ( $ch );
        return $return;
    }
}