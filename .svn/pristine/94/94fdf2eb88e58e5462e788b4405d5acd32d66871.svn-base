<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/12
 * Time: 22:09
 */

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
require_once('../saeDao.php');
$arr = null;
$mmc = memcache_init();
if ($mmc == false) {
    echo "mc init failed\n";
}else {
    $auction_id = $_REQUEST['auc_id'];
    $where = array("auction_id" => $auction_id);
    $out = get($where,'auction');
    if($out) {
        $where2 = array("wechat_id" => $out[0]['wechat_id']);
        $item_pack = memcache_get($mmc, $out[0]['num_iid']."_info");
        // 获得买家信息
        $out2 = get($where2,"user_info");
        if($out2) {
            $arr['state'] =true;
            $arr['num_iid'] = $out[0]['num_iid'];
            $arr['email'] = $out2[0]['email'];
            $arr['email_name'] = utf_substr(strstr($out2[0]['email'],'@',true),7);
            $arr['mobile'] = $out2[0]['mobile'];
            $arr['price'] = $item_pack['price'];
            $arr['item'] = utf_substr($out[0]['item_info'],16);
            $arr['seller'] = $out[0]['seller_wechat_id'];
            $result = json_encode($arr);
            $callback=$_GET['callback'];
            echo $callback."($result)";
        }else {
            $arr['state'] = false;
            $result = json_encode($arr);
            $callback=$_GET['callback'];
            echo $callback."($result)";
        }
    }
}




