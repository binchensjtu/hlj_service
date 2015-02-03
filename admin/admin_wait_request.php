<?php
/**
 * Created by PhpStorm.
 * User: PegionAndLion
 * Date: 15/1/4
 * Time: 下午6:57
 */
// 取得所有上架商品
require_once('../saeDao.php');
require_once('../mail.php');
$where = array("is_outer"=>0, "state"=>"WAIT_ADMIN_REQUEST");
$out = get($where,"auction");
$count = count($out);
$mmc = memcache_init();
if ($mmc == false) {
    echo "mc init failed\n";
}
function utf_substr($str,$len)
{
    for($i=0;$i<$len;$i++)
    {
        $temp_str=substr($str,0,1);
        if(ord($temp_str) > 127)
        {
            $i++;
            if($i<$len)
            {
                $new_str[]=substr($str,0,3);
                $str=substr($str,3);
            }
        }
        else
        {
            $new_str[]=substr($str,0,1);
            $str=substr($str,1);
        }
    }
    return join($new_str,'');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>红领巾砖姐后台</title>
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="http://7u2les.com1.z0.glb.clouddn.com/jquery.mobile.min.css"/>
    <link rel="stylesheet" href="http://7u2les.com1.z0.glb.clouddn.com/another.css"/>
    <script src="http://7u2les.com1.z0.glb.clouddn.com/jquery-2.0.3.min.js"></script>
    <script src="http://7u2les.com1.z0.glb.clouddn.com/jquery.mobile.min.js"></script>
    <script src="http://7u2les.com1.z0.glb.clouddn.com/av-mini.js"></script>
    <style>
        #mani {
            z-index: 10 !important;
        }

        .ui-block-title {
            font-size: 0.8em;
            right: 0;
            width: 50% !important;
            padding: 5px;
            padding-left: 9px;
        }

        .mani-sellers, .mani-alarm {
            height: 30px;
            font-size: 0.8em;
            top: 5px;
        }

        .ui-block-img {
            max-width: 25%;
        }

        .ui-block-mani {
            max-width: 25%;
        }
        .ui-grid-b {
            margin-top: 10px;
            margin-bottom: 10px;
            padding-bottom: 5px;
            padding-top: 5px;
            border-bottom: 1px solid #a5a5a5;
        }

        #sellerFloat {
            position: fixed;
            left: 10px;
            right: 10px;
            background-color: #efeff5;
            height: 380px;
            top: 45px;
            border-radius: 8px;
            text-align: center;
            z-index: 1000;
            visibility: hidden;
        }

        #sellerFloatBottom {
            visibility: hidden;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0px;
            left: 0px;
            display: block;
            z-index: 999;
            background-color: rgb(0, 0, 0);
            opacity: 0.65;
            border: 1px solid;
        }
        #closeSeller {
            position: absolute;
            left: 2.5%;
            top: 5px;
        }
        .grey {
            color: gray!important;
        }
    </style>
</head>
<body>
<div id="sellerFloatBottom">

</div>
<div data-role="page" id="testpage">
    <div data-role="header" data-position="fixed">
        <div data-role="navbar">
            <ul id="mani">
                <li><a href="#" class="ui-btn-active" data-ajax='false'>待分配</a></li>
                <li><a href="./admin_requested.php" data-ajax='false'>已分配</a></li>
                <li><a href="./admin_create_pay.php" data-ajax='false'>待打款</a></li>
                <li><a href="./admin_payed.php" data-ajax='false'>已打款</a></li>
            </ul>
        </div>
    </div>
    <!-- /header -->
    <div class="ui-content" role="main">
        <div id="item-wrapper">
            <?php
            $mmc = memcache_init();
            if ($mmc == false) {
                echo "mc init failed\n";
            }
            for($i= $count-1; $i >= 0; $i--) {
                    $item_pack = memcache_get($mmc, $out[$i]['num_iid']."_info");
                    ?>
                <div class="ui-grid-b">
                    <div class="ui-block-a ui-block-img">
                        <a href='<?php echo $item_pack['detail_url'] ?>'>
                            <img
                                src='<?php echo $item_pack['pic_thumb_url'] ?>'
                                style="width:80px;max-height: 80px;">
                        </a>
                    </div>
                    <div class="ui-block-b ui-block-title">
                        <p><?php echo utf_substr($out[$i]['item_info'],90)?></p>
                    </div>
                    <div class="ui-block-c ui-block-mani">
                        <?php
                            if($out[$i]['seller_wechat_id']) {
                                $realName = memcache_get($mmc, $out[$i]['seller_wechat_id']."_seller");
                                $realName = $realName['realName'];
                                ?>
                                <button class='mani-sellers grey' id='<?php echo $out[$i]['auction_id'] ?>'><?php echo $realName ?></button>
                        <?php
                            }else {
                                ?>
                                <button class='mani-sellers' id='<?php echo $out[$i]['auction_id'] ?>'>指定买手</button>
                            <?php
                            }
                        ?>

                        <button class='mani-alarm' id='<?php echo $out[$i]['auction_id'] ?>'>发送提醒</button>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div id="sellerFloat">
        <p class="pay_alert">指定买手</p>
        <a href="#" class="ui-btn ui-icon-delete ui-btn-icon-notext ui-corner-all" id="closeSeller">No text</a>
        <ul data-role="listview" id="deliverUl">
            <li>
                <select name="countries" id="countries" data-native-menu="true">
                    <option value="no"><-请选择国家-></option>
                        <option value="日本">日本</option>
                        <option value="香港">香港</option>
                        <option value="美国">美国</option>
                        <option value="法国">法国</option>
                        <option value="德国">德国</option>
                        <option value="韩国">韩国</option>
                        <option value="测试用">测试用</option>
                        <option value="澳大利亚">澳大利亚</option>
                </select>
                <select name="sellers" id="sellers" data-native-menu="true" disabled="true">
                        <option value="no"><-请选择买手-></option>
                </select>
            </li>
            <li>
                <div class="ui-grid-a">
                    <div class="ui-block-a">
                        <a href="#" data-role="button" id='cancel' data-theme='a'>取消</a>
                    </div>
                    <div class="ui-block-b">
                        <a href="#" data-role="button" id='sub' data-theme='b'>确定</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <script>
        $(document).ready(function(){
            var auc_id = null;
            $('.mani-sellers').click(function(){
                $('#sellerFloat').css('visibility','visible');
                $('#dsellerFloatBottom').css('visibility','visible');
                auc_id = $(this).attr('id');
            });
            $('#cancel').click(function(){
                $('#sellerFloat').css('visibility','hidden');
                $('#sellerFloatBottom').css('visibility','hidden');
            });
            $('#closeSeller').click(function(){
                $('#sellerFloat').css('visibility','hidden');
                $('#sellerFloatBottom').css('visibility','hidden');
            });
            $('#countries').on('change',function(){
                var that =$(this);
                var countries = $('#countries').val();
                $('#sellers').parent().find('span').text('<-请选择买手->');
                $('#sellers').val('no');
                if(countries === "no") {
                    $('#sellers').attr("disabled",true);
                    $('#sellers-button').addClass('ui-state-disabled');
                    $('#sellers').parent().find('span').text('<-请选择买手->');
                    $('#sellers').val('no');
                }else {
                    $('#sellers').load('./fetch_sellers.php',that.serialize(),function() {
                        $('#sellers-button').removeClass('ui-state-disabled');
                        $('#sellers').attr('disabled',false);
                    });
                }
            });
            $("#sub").bind("click",function(event){
                var countries = $('#countries').val();
                var seller = $('#sellers').val();
                seller_name = $('#sellers').parent().find('span').text();
                // 必须填单号
                if(countries!='no' && seller!='no') {
                    $.ajax({
                        url: "./get_seller_ocupied.php",
                        type: "POST",
                        dataType: 'jsonp',
                        jsonp: 'callback',
                        data: {
                            "auc_id"    : auc_id,
                            "s_uwid"    : seller
                        },
                        timeout: 10000,
                        success: function (json) {
                            if (json['state'] === true) {
                                alert("指派成功");
                                $('#sellerFloat').css('visibility','hidden');
                                $('#sellerFloatBottom').css('visibility','hidden');
                                $('.mani-sellers').filter('#'+ auc_id).text(seller_name).addClass('grey');
                            }else {
                                alert("指派失败,请重试");
                            }

                        }
                    });
                }else {
                    alert("未选择国家/买手");
                }
            });

        });
    </script>
    <script>
        $(document).ready(function(){
            AV.initialize("t2p638n2p3ubeb4kz5ec91cfgzv3zcihjwjqdgqldsps7lcg", "zvb3jrenbp96xgv5rbgioh5lk0k4gavozwvtthzuce7c3c0e");
            var auc_id = null;
            $('.mani-alarm').click(function(){
                var that = $(this);
                auc_id = $(this).attr('id');
                $.ajax({
                    url: "./get_seller_info.php",
                    type: "POST",
                    dataType: 'jsonp',
                    jsonp: 'callback',
                    data: 'auc_id='+ auc_id,
                    timeout: 5000,
                    success: function (json) {
                        if(json['state'] == true) {
                            var email = json['email'];
                            var mobile = json['mobile'];
                            var price = json['price'];
                            var seller = json['seller'];
                            if(price == 1.0 || price == "" || price == null || price == "null") {
                                alert("芳芳，你还木有修改价格呢！");
                            } else {
                                if(seller) {
                                    var r=confirm("买家邮箱："+email+"\n买家电话："+mobile+"\n修改后价格："+price);
                                    if (r===true)
                                    {
                                        AV.Cloud.requestSmsCode({
                                            mobilePhoneNumber: mobile,
                                            template: "确定需求，要求付款",
                                            name: json['email_name'],
                                            item: json['item'],
                                            ttl: 5
                                        }).then(function(){
                                            $.ajax({
                                                url: "./update_alarm.php",
                                                type: "POST",
                                                dataType: 'jsonp',
                                                jsonp: 'callback',
                                                data: {
                                                    "auc_id"    : auc_id,
                                                    "price"     : price
                                                },
                                                timeout: 10000,
                                                success: function (json) {
                                                    if (json['state'] == true) {
                                                        alert("操作结束=。=");
                                                        that.parent().parent().fadeOut("slow");
                                                    }else {
                                                        alert("提醒失败，请联系欢欢手动修改");
                                                    }

                                                }
                                            });
                                        }, function(err){
                                            alert("提醒失败请重试");
                                        });
                                    }
                                    else
                                    {
                                        alert("本次操作已被取消");
                                    }
                                } else {
                                    alert("芳芳，你还木有指定买手！")
                                }

                            }
                        }else {
                            alert("获取信息失败");
                        }
                    }
                });
            });
        });
    </script>
</div>
</body>
</html>