<?php

if (! function_exists('fun_respon')) {
    /**
     *  return json maxed
     */
    function fun_respon($success, $res = [], $code = 200)
    {
        $result['code'] = $code;
        if ($success == 200) {
            $result['data'] = $res;
        } else {
            $result['error'] = $res;
        }
        header("Content-Type: application/json; charset=UTF-8");
        exit(json_encode($result));
    }
}