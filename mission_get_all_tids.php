<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/8
 * Time: 23:42
 */
require_once __DIR__ . '/libs/KdtApiClient.php';
date_default_timezone_set('PRC');
$appId = '15db6704596966a91b';
$appSecret = '7e6254589d51c55c4b52f7578806e82c';
// 调用有赞对象
$client = new KdtApiClient($appId, $appSecret);

// 定时任务获取2小时内的交易
$method = 'kdt.trades.sold.get';
$params = array(
    "page_size" => 10000
);
$out = $client->post($method, $params);
$trades = $out["response"]["trades"];
$mmc = memcache_init();
if ($mmc == false) {
    echo "mc init failed\n";
}
for($i=0; $i < count($trades); $i++) {
    memcache_set($mmc, $trades[$i]['tid']."_info",$trades[$i]);
}