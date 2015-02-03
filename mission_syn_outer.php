<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/15
 * Time: 22:43
 */
require_once __DIR__ . '/libs/KdtApiClient.php';
require_once('./saeDao.php');
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
for($i=0; $i < count($trades); $i++) {
    $phone = $trades[$i]['receiver_mobile'];
    $whereUser = array("mobile" => $phone);
    $reUser = get($whereUser,"user_info");
    if($reUser) {
        $uwid = $reUser[0]['wechat_id'];
        $whereAuction = array("tid" => $trades[$i]['tid']);
        $reAuc = get($whereAuction,"auction");
        if(!$reAuc['wechat_id']) {
            $paraUpdateAuc = array("wechat_id"=>$uwid);
            update($paraUpdateAuc,$whereAuction,"auction");
        }
    }
}