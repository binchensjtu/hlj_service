<?php
/**
 * Created by PhpStorm.
 * User: MR X6
 * Date: 2015/1/13
 * Time: 20:33
 */

require_once('../saeDao.php');
$tid = $_REQUEST['tid'];
$param =  array("admin_payed" => 1);
$where = array("tid" => $tid);
update($param,$where,"auction");
$arr = null;
$arr = array("state" => true);
$result = json_encode($arr);
$callback=$_GET['callback'];
echo $callback."($result)";
