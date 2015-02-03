<?php
function std_class_object_to_array($stdclassobject)
{
    $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;

    foreach ($_array as $key => $value) {
        $value = (is_array($value) || is_object($value)) ? std_class_object_to_array($value) : $value;
        $array[$key] = $value;
    }

    return $array;
}

function get_wx_access_token() {
    $temp = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx29cc85099ab49c0a&secret=3a45e794655c15ec80e93fd62e731860');
    $a = std_class_object_to_array(json_decode($temp));
    $mmc = memcache_init();
    if ($mmc == false) {
        echo "mc init failed\n";
    }
    memcache_set($mmc, 'hlj_service_wx_token',$a['access_token']);
}

