<?php
/**
 * Created by PhpStorm.
 * User: PegionAndLion
 * Date: 14/12/18
 * Time: 上午10:53
 */
require_once('saeDao.php');
session_start();
$_SESSION['uwid'] = $_REQUEST['uwid'];
$_SESSION['code'] = $_REQUEST['keyword'];


?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>红领巾海外代购</title>
    <meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" name="viewport">
    <link rel="stylesheet" href="http://7u2les.com1.z0.glb.clouddn.com/jquery.mobile.min.css"/>
    <link rel="stylesheet" href="http://7u2les.com1.z0.glb.clouddn.com/cust.css"/>
    <script src="http://7u2les.com1.z0.glb.clouddn.com/jquery-2.0.3.min.js"></script>
    <script src="http://7u2les.com1.z0.glb.clouddn.com/jquery.mobile.min.js"></script>
    <script src="http://7u2les.com1.z0.glb.clouddn.com/jquery.validate.min.js"></script>
</head>
<body>

<div data-role="page" id="home">
    <div data-role="header" data-position="fixed">
        <h1>红领巾成员注册</h1>
    </div>
    <div class="ui-body ui-body-a content-it">
        <form method="post" action="sellRegSuc.php" id="sellerForm">
            <ul data-role="listview">
                <li>
                    <div class="clearfix">
                        <label for="realName">请填写你的真实姓名(*)</label>
                        <input type="text" name="realName" id="realName" value=""  data-clear-btn="true"> 
                    </div>
                    <div class="clearfix">
                        <label for="wechat_num">请填写你的微信号(*)</label>
                        <input type="text" name="wechat_num" id="wechat_num" value=""  data-clear-btn="true"> 
                    </div>
                    <div class="clearfix">
                        <label for="email">请填写你的常用邮箱(*)</label>
                        <input type="email" name="email" id="email" value=""  data-clear-btn="true"> 
                    </div>
                    <div class="clearfix">
                        <label for="mobile">请填写你的手机号码(选填，国内请一定填写)</label>
                        <input type="tel" name="mobile" id="mobile" value=""  data-clear-btn="true"> 
                    </div>
                    <label for="country" class="select">请选择你所在国家/地区</label>
                    <select name="country" id="country" data-native-menu="true">
                            <option value="大陆">大陆</option>
                            <option value="日本">日本</option>
                            <option value="香港">香港</option>
                            <option value="美国">美国</option>
                            <option value="法国">法国</option>
                            <option value="英国">英国</option>
                            <option value="德国">德国</option>
                            <option value="澳大利亚">澳大利亚</option>
                            <option value="其他国家">其他国家</option>
                    </select>
                </li>
            </ul>
            <input type="submit" value="下一步" data-transition="slideup"  data-theme="b" id="sub">
            <script>
                $().ready(function() {
                    jQuery.validator.addMethod("isMobile", function(value, element) {
                        var length = value.length;
                        var mobile = /^1[3|4|5|8|7][0-9]\d{4,8}$/;
                        return this.optional(element) || (length == 11 && mobile.test(value));
                    }, "请正确填写您的手机号码");

                    $("#sellerForm").validate({
                        errorPlacement: function(error, element) {
                            error.appendTo(element.parent());
                        },
                        rules: {
                            realName: "required",
                            wechat_num: "required",
                            mobile: {
                                isMobile: true
                            },
                            email: {
                                required: true,
                                email: true
                            }
                        },
                        messages:{
                            realName : "真实姓名不能为空",
                            wechat_num: "微信号不能为空",
                            mobile:{
                                isMobile:"请填写正确的手机号码"
                            },
                            email:{
                                required:"常用邮箱不能为空",
                                email:"请填写正确的邮箱地址"
                            }
                        }
                    });
                });
            </script>
        </form>
    </div>
    <div data-role="footer" data-position="fixed">
        <h4>红领巾海外代购</h4>
    </div>
</div>
</body>
</html>