<?php
/**
 * Created by PhpStorm.
 * User: PegionAndLion
 * Date: 14/12/26
 * Time: 上午10:25
 */

require_once('../saeDao.php');
$auction_id = $_REQUEST['auc_id'];
$seller_wechat_id = $_REQUEST['s_uwid'];
$param =  array("seller_wechat_id" => $seller_wechat_id);
$where = array("auction_id" => $auction_id);
$out = update($param,$where,"auction");
$arr = null;
$arr = array("state" => true);
$result = json_encode($arr);
$callback=$_GET['callback'];
echo $callback."($result)";
