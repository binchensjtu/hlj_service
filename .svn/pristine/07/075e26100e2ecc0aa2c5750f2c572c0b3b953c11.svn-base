<?php
require_once('saeDao.php');
session_start();

$count = $_POST['number'];
$pub_id = $_POST['pubID'];
$phone = $_POST['mobile'];
$totalPrice = $_POST['totalHidden'];
$is_outer = 1;

// 查找是否有这个用户
$where = array("mobile"=>$phone);
$out = get($where,"user_info");
// 如果是注册用户，取得其手机号
if($out) {
    $wechat_id = $out[0]["wechat_id"];
}

// 取得卖家信息
$where = array("id"=>$pub_id);
$out = get($where,"pub");
if($out) {
    $seller_wechat_id = $out[0]["uwid"];
    $country = $out[0]["country"];
    $item_info = $out[0]["title"];
    $post_fee  = $out[0]["post_fee"];
}

// 创建物流单

$datetime = date('Y-m-d H:i:s',time());
// 插入订单，以便后续跟踪
$para = array("uwid"=>$wechat_id,"phone"=>$phone,"ac_date"=>$datetime);
$logi = insert($para,"logistic");

if($logi) {
    $para = array("wechat_id"=>$wechat_id,"country"=>$country,"item_info"=>$item_info,
        "count"=>$count,"state"=>0,"auc_time"=>$datetime,"logistic_id"=>$logi,"pub_id"=>$pub_id,
        "is_outer"=>$is_outer,"seller_wechat_id"=>$seller_wechat_id,"totalPrice"=>$totalPrice,"post_fee"=>$post_fee);
    insert($para,"auction");
}
// 发布拍下数+1
$where = array("id" => $pub_id);
$out = get($where,"pub");
if($out) {
    $auc_count  = $out[0]["auc_count"];
}
$auc_count = (int)$auc_count + 1;
$para = array("auc_count"=>$auc_count);

update($para,$where,"pub");


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <title></title>
    <style>
        #fuck {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 3;
            height: 800px;
            overflow: hidden;
        }
        #hello {
            background: #c60a1e;
            color: white;
            padding: 20px 5px 20px 10px;
            font: normal 14px/22px Arial,"Microsoft YaHei";
            height: 200px;
            position: relative;
            top: 20px;
        }
        #outer {
            position: relative;

        }
        #inner {
            position: fixed;
            top: 100px;
            height: 200px;
            width: 90%;
            text-align: center;
            z-index: 100;
            left: 5%;
        }
        #info {
            position: absolute;
            top: 180px;
            left: 38%;
            height: 40px;
            width: 30%;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<div id="outer">
    <div id="inner">
        <p id="hello">订单金额合计<?php echo $_POST['totalHidden'] ?>元，购买<?php echo (int)$_POST['totalHidden'] ?>朵小红花，才能完成交易哦！╭(￣▽￣)╯</p>
        <button id="info" onclick="jumpurl();">我知道了</button>
    </div>
    <iframe src="http://wd.koudai.com/item.html?itemID=664015408" frameborder="0" name="fuck" id="fuck" scrolling="no"></iframe>
</div>
<script>
    function jumpurl(){
        location='http://wd.koudai.com/item.html?itemID=664015408';
    }
</script>

</body>

</html>
