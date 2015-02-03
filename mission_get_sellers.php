<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/13
 * Time: 1:12
 */
require_once('./saeDao.php');
$mmc = memcache_init();
if ($mmc == false) {
    echo "mc init failed\n";
}else {
    $where = null;
    $out = get($where,"seller");
    if($out) {
        for($i = 0; $i < count($out); $i++) {
            memcache_set($mmc, $out[$i]['wechat_id']."_seller",$out[$i]);
        }
    }
}



