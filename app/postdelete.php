<?php
session_start();

require_once('config.php');

$getller = new Todocontroller();
$postresult = $getller->postdelete();

$response2 = '非同期通信 成功';
$json = json_encode($response2);
echo $json;
?>