<?php
/**
 * Created by PhpStorm.
 * User: PegionAndLion
 * Date: 15/1/9
 * Time: 下午7:25
 */
require_once('../saeDao.php');
$tid = $_REQUEST['tid'];
$mmc = memcache_init();
if ($mmc == false) {
    echo "mc init failed\n";
}
$where = array("tid" => $tid);
$out = get($where,"auction");
$pack = memcache_get($mmc, $tid."_info");
$pack['info'] = $out[0]['item_info'];
if($out[0]['ps']) {
    $pack['dps'] = $out[0]['ps'];
}else {
    $pack['dps'] = "无";
}
$sellerKey = $out[0]['seller_wechat_id'];
$realName = memcache_get($mmc, $sellerKey."_seller");
$realName = $realName['realName'];
$pack['sellerName'] = $realName;
$result = json_encode($pack);
$callback=$_GET['callback'];
echo $callback."($result)";
