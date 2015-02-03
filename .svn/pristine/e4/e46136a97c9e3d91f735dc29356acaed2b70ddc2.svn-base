<?php
header("Content-Type: text/html; charset=utf-8");
require_once(dirname(__FILE__) . '/' . 'IGt.Push.php');

define('APPKEY', 'cMqdls70ha8Y0cHjETYlI7');
define('APPID', 'WPKYGCCGhSAQH9iUDCSW43');
define('MASTERSECRET', 'Fp16LROkwfA2MUQcgl2Z05');
define('HOST', 'http://sdk.open.api.igexin.com/apiex.htm');
define('CID', '5437d50ca182949497eba291a4a8ce27');
define('CID2', '1fe217973a67e73d21e92a0462fab1cd');

//单推接口案例
function pushMessageToFangFang($type)
{
    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    if($type == "pay") {
        $template = IGtLinkTemplateDemoPay();
    }else {
        $template = IGtLinkTemplateDemo();
    }


    //个推信息体
    $message = new IGtSingleMessage();
    $message->set_isOffline(true);//是否离线
    $message->set_offlineExpireTime(3600 * 12 * 1000);//离线时间
    $message->set_data($template);//设置推送消息类型
    $message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
    //接收方
    $target = new IGtTarget();
    $target->set_appId(APPID);
    $target->set_clientId(CID);


    $rep = $igt->pushMessageToSingle($message, $target);

    var_dump($rep);
    echo("<br><br>");
}

function pushMessageToHuanHuan($type)
{
    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    if($type == "pay") {
        $template = IGtLinkTemplateDemoPay();
    }else {
        $template = IGtLinkTemplateDemo();
    }

    //个推信息体
    $message = new IGtSingleMessage();
    $message->set_isOffline(true);//是否离线
    $message->set_offlineExpireTime(3600 * 12 * 1000);//离线时间
    $message->set_data($template);//设置推送消息类型
    $message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
    //接收方
    $target = new IGtTarget();
    $target->set_appId(APPID);
    $target->set_clientId(CID2);
    $rep = $igt->pushMessageToSingle($message, $target);

    var_dump($rep);
    echo("<br><br>");
}

function IGtLinkTemplateDemo()
{
    $template = new IGtLinkTemplate();
    $template->set_appId(APPID);//应用appid
    $template->set_appkey(APPKEY);//应用appkey
    $template->set_title("红领巾管理员通知");//通知栏标题
    $template->set_text("有用户提交了买买买需求，请尽快处理");//通知栏内容
    $template->set_logo("http://bcs.duapp.com/caolixiang33/hlj.png");//通知栏logo
    $template->set_isRing(true);//是否响铃
    $template->set_isVibrate(true);//是否震动
    $template->set_isClearable(true);//通知栏是否可清除
    $template->set_url("http://mytaotao123.sinaapp.com/admin/admin_wait_request.php");//打开连接地址
    // iOS推送需要设置的pushInfo字段
    //$template ->set_pushInfo($actionLocKey,$badge,$message,$sound,$payload,$locKey,$locArgs,$launchImage);
    //$template ->set_pushInfo("",2,"","","","","","");
    return $template;
}

function IGtLinkTemplateDemoPay()
{
    $template = new IGtLinkTemplate();
    $template->set_appId(APPID);//应用appid
    $template->set_appkey(APPKEY);//应用appkey
    $template->set_title("红领巾管理员通知");//通知栏标题
    $template->set_text("有买手已经发货，请打款");//通知栏内容
    $template->set_logo("http://bcs.duapp.com/caolixiang33/hlj.png");//通知栏logo
    $template->set_isRing(true);//是否响铃
    $template->set_isVibrate(true);//是否震动
    $template->set_isClearable(true);//通知栏是否可清除
    $template->set_url("http://mytaotao123.sinaapp.com/admin/admin_create_pay.php");//打开连接地址
    // iOS推送需要设置的pushInfo字段
    //$template ->set_pushInfo($actionLocKey,$badge,$message,$sound,$payload,$locKey,$locArgs,$launchImage);
    //$template ->set_pushInfo("",2,"","","","","","");
    return $template;
}

?>
