<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/8
 * Time: 22:29
 */
require_once __DIR__ . '/libs/KdtApiClient.php';
date_default_timezone_set('PRC');
$appId = '15db6704596966a91b';
$appSecret = '7e6254589d51c55c4b52f7578806e82c';
$client = new KdtApiClient($appId, $appSecret);
// 获取在售商品
$method = 'kdt.items.onsale.get';
$param = array(
    "page_size" => 10000,
);
$out = $client->post($method,$param);
$items = $out['response']['items'];
$mmc = memcache_init();
if ($mmc == false) {
    echo "mc init failed\n";
}
for($i=0; $i < count($items); $i++) {
    memcache_set($mmc, $items[$i]['num_iid']."_info",$items[$i]);
}

// 获取售罄商品
$method = 'kdt.items.inventory.get';
$param = array(
    "page_size" => 10000,
    "banner" => "sold_out",
);
$out = $client->post($method,$param);
$items = $out['response']['items'];
for($i=0; $i < count($items); $i++) {
    memcache_set($mmc, $items[$i]['num_iid']."_info",$items[$i]);
}

// 获取下架商品
$method = 'kdt.items.inventory.get';
$param = array(
    "page_size" => 10000,
    "banner" => "for_shelved",
);
$out = $client->post($method,$param);
$items = $out['response']['items'];
for($i=0; $i < count($items); $i++) {
    memcache_set($mmc, $items[$i]['num_iid']."_info",$items[$i]);
}


