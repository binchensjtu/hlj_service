<?php
/**
 * 使用BCS云存储，保存处理后的图片(注意：需要用户开启云存储服务)
 */
require_once 'bcs.class.php';


function uploadAnImage($url,$filename) {
    $host = 'bcs.duapp.com'; //online
    $ak = '1oQGuegQAtLmW9bPCOxYjLA1';
    $sk = 'IG4NGIbTgWU92hS6GTxS1rP26DqFlgVx';
    $bucket = 'honglongjin-service';

    $f = new SaeFetchurl();
    $img_data = $f->fetch($url);
    $img = new SaeImage();
    $img->setData($img_data);
    $img->resize(300);
    $new_data = $img->exec(); // 执行处理并返回处理后的二进制数据
    $imageSrc = $new_data;

    /**** 将结果保存到云存储****/
    $baiduBCS = new BaiduBCS($ak, $sk, $host);
    //object name
    $fileFinal = $filename.'.jpg';//填入您要保存的名称
    $object = '/' . $fileFinal; //object必须以‘/’开头

    //将图片存入云存储
    //$imageSrc即为请求image服务成功后返回的图片二进制数据
    $contenttype="image/jpeg";
    $baiduBCS->create_object_by_content($bucket, $object, $imageSrc, array('acl'=>'public-read',
        'contenttype'=>$contenttype));
//
//    $acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ;
//    $baiduBCS->set_object_acl($bucket, $object, $acl);
}

?>


