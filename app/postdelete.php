<?php
session_start();

require_once('config.php');

$getller = new Todocontroller();
$postresult = $getller->postdelete();

$response2 = '非同期通信 成功 一言空っぽ';
echo json_encode($response2);

?>