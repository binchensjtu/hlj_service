<?php
/**
 * Created by PhpStorm.
 * User: PegionAndLion
 * Date: 14/12/26
 * Time: 上午10:25
 */

require_once('./get_ticket.php');


function invcode($length,$num=1) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $j = 0;
    $code_arr = array();
    while($j<$num){
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        $code_arr[$j] = $random;
        $j++;
    }
    return $code_arr;
}
// Init memcache
$mmc = memcache_init();
if ($mmc == false) {
    echo "mc init failed\n";
}

$arr['ticket'] = memcache_get($mmc, 'hlj_service_wx_ticket');
$arr['noncestr'] = invcode(20);

$result = json_encode($arr);
$callback=$_GET['callback'];
echo $callback."($result)";

?>