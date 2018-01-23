<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MusicController extends Controller
{
    public function lists()
    {
        $list = [
            ["urls"=>"http://vip.baidu190.com/uploads/2017/20170207ff925ef6f268a5563f0552c3ba141f.mp3","author"=>"杨宗纬","name"=>"凉凉"],
            ["urls"=>"http://vip.baidu190.com/uploads/2017/2017102c57e85460e4e9ee576f90583a40236b.mp3","author"=>"陈一发","name"=>"童话镇"],
            ["urls"=>"http://vip.baidu190.com/uploads/2017/2016076a16a68ba55e721878650753d0c3256a.mp3","author"=>"袁娅维","name"=>"说散就散"]
        ];
        return $list;
    }
}
