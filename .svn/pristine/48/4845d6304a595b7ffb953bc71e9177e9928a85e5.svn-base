<?php
/**
 * Created by PhpStorm.
 * User: PegionAndLion
 * Date: 14/12/26
 * Time: 上午10:25
 */

require_once __DIR__ . '/libs/KdtApiClient.php';
require_once('saeDao.php');
$appId = '15db6704596966a91b';
$appSecret = '7e6254589d51c55c4b52f7578806e82c';
$client = new KdtApiClient($appId, $appSecret);
$method = 'kdt.item.update.listing';
$num_iid = $_REQUEST['id'];
$params = array(
    "num_iid" => $num_iid,
);
$a = $client->post($method,$params);
$param =  array("shon_off"=>1);
$where = array("num_iid"=>$num_iid);
update($param,$where,"pub");
$arr = array("state" => $a['response']['item']['is_listing']);
$result = json_encode($arr);
$callback=$_GET['callback'];
echo $callback."($result)";


?>