<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/13
 * Time: 20:33
 */

require_once('../saeDao.php');
require_once('../mail.php');
$auction_id = $_REQUEST['auc_id'];
$param =  array("is_alarmed" => 1,"state"=>"ADMIN_REQUESTED");
$where = array("auction_id" => $auction_id);
update($param,$where,"auction");
$out = get($where,"auction");
$id = $out[0]['wechat_id'];
$itemInfo = $out[0]['item_info'];
if($out[0]['ps'] == ''){
    $itemPS = "无";
}else {
    $itemPS = $out[0]['ps'];
}
$reUser = get(array("wechat_id"=>$id),"user_info");
$emailName = strstr($reUser[0]['email'],'@',true);
$mailcontent = "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title></title>
</head>
<body>

<p>亲爱的{$emailName}：</p>
<p>你提交的代购需求，红领巾已确认有货。请尽快至【红领巾】微信订阅号中完成付款，我们将以最快的速度发货。</p>
<br />
<pre>订单信息
商品信息：{$itemInfo}
备注信息：{$itemPS}
总价（含邮费）：{$_REQUEST['price']}</pre>
<br />
<pre>如何付款？
STEP1：进入【红领巾】微信订阅号
STEP2：在【红领巾】订阅号中，输入“我的订单”。
STEP3：在“待付款”列表中，完成付款。
<b style='color:red;'>近期微信支付不稳定，如果不能成功使用“微信支付”，建议选择“其他支付方式-信用卡/储蓄卡”进行付款。</b></pre>

<img src='http://testhlj.qiniudn.com/hlj_weixin_logo.jpg' alt='logo'/>
</body>
</html>";

send_mail_lazypeople($reUser[0]['email'],
    "红领巾通知",
    $mailcontent);

$arr = null;
$arr = array("state" => true);
$result = json_encode($arr);
$callback=$_GET['callback'];
echo $callback."($result)";
