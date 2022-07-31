<?php
session_start();

require_once('config.php');

$getller = new Todocontroller();
$postresult = $getller->postdelete();

$postresponse = '非同期通信＆削除 成功';
$json = json_encode($postresponse);
echo $json;

?>