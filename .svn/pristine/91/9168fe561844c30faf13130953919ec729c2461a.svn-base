<?php
function shorturl($long_url){
    $apiKey='209678993';//要修改这里的key再测试哦
    $apiUrl='http://api.t.sina.com.cn/short_url/shorten.json?source='.$apiKey.'&url_long='.$long_url;
    $response = file_get_contents($apiUrl);
    $json = json_decode($response);
    return $json[0]->url_short;
}

function expandurl($short_url){
    $apiKey='209678993';//要修改这里的key再测试哦
    $apiUrl='http://api.t.sina.com.cn/short_url/expand.json?source='.$apiKey.'&url_short='.$short_url;
    $response = file_get_contents($apiUrl);
    $json = json_decode($response);
    return $json[0]->url_long;
}

echo shorturl("http://hljbloginfo.duapp.com/wordpress/?p=138");



?>