<?php
/**
 * Created by PhpStorm.
 * User: PegionAndLion
 * Date: 15/1/9
 * Time: 下午7:25
 */
require_once('saeDao.php');
$tid = $_REQUEST['tid'];
$mmc = memcache_init();
$where = array("tid" => $tid);
$out = get($where,"logistic");
$result = json_encode($out[0]);
$callback=$_GET['callback'];
echo $callback."($result)";
