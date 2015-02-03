<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/15
 * Time: 21:55
 */
session_start();
require_once('../saeDao.php');
$_SESSION['we_chat'] = $_POST['we_chat'];
$_SESSION['mobile'] = $_POST['mobile'];
$_SESSION['email'] = $_POST['email'];
// 开始插入数据
$mysql = new SaeMysql();
// 插入个人信息
$datetime = date('Y-m-d H:i:s',time());
$para = array("wechat_id"=>$_SESSION['uwid'],"wechat_num"=>$_SESSION['we_chat'],"mobile"=>$_SESSION['mobile'],"email"=>$_SESSION['email'],
    "is_new"=>'0',"date"=>$datetime);
$lastId = insert($para,"user_info");

sleep(2);
$where = array("id" => $lastId);
$out = get($where,"user_info");
$mobile = $out[0]['mobile'];

$whereLogi = array("phone"=>$mobile);
$okRecord = get($whereLogi,"logistic");

for($i=0; $i < count($okRecord);$i++) {
    $tid = $okRecord[$i]['tid'];
    $para = array("wechat_id"=> $_SESSION['we_chat']);
    $where = array("tid" => $tid);
    update($para,$where,"auction");
}
header('Location: buyer_wait_request.php?uwid=' . $_SESSION['uwid']);


