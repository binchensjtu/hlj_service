<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/7
 * Time: 20:50
 */
$method = '';
$that = $_REQUEST;
foreach($that as $key => $val) {
    if($key == 'native_overseas') {
        $method = $val;
    }
}

if($method == 'native') { ?>
    <option value="no"><-请选择快递公司-></option>
    <option value="7,shunfeng">顺丰快递</option>
    <option value="4,yunda">韵达快递</option>
    <option value="3,zhongtong">中通快递</option>
    <option value="2,yuantong">圆通快递</option>
    <option value="1,shentong">申通快递</option>
    <option value="5,tiantian">天天快递</option>
    <option value="6,huitongkuaidi">百世汇通</option>
<?php
} else if($method == 'overseas') { ?>
    <option value="no"><-请选择快递公司-></option>
    <option value="41,del_de">德国DHL</option>
    <option value="41,us_chinese">美国华人快递</option>
    <option value="11,ems">国际EMS</option>
<?php
}

?>