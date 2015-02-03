<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/11
 * Time: 15:32
 */
require_once('./getAc.php');


function getTicket() {
    // Init memcache
    $mmc = memcache_init();
    if ($mmc == false) {
        echo "mc init failed\n";
    }
    // 获取缓存的TOKEN
    $token = memcache_get($mmc, 'hlj_service_wx_token');
    $temp = file_get_contents('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$token.'&type=jsapi');
    $a = std_class_object_to_array(json_decode($temp));
    if($a['errmsg'] =="ok") {
        memcache_set($mmc, 'hlj_service_wx_ticket',$a['ticket']);
    }else {
        // 重新获取ACCESS_TOKEN
        get_wx_access_token();
        $token = memcache_get($mmc, 'hlj_service_wx_token');
        $temp = file_get_contents('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$token.'&type=jsapi');
        $a = std_class_object_to_array(json_decode($temp));
        memcache_set($mmc, 'hlj_service_wx_ticket',$a['ticket']);
    }
}

