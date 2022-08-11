<?php

require_once('config.php');
// require_once(__DIR__ .'./../../config.php');

$getller = new Todocontroller();
$fileresult = $getller->filedelete();

$fileresponse = '非同期通信＆削除機能 成功';
echo json_encode($fileresponse);
echo $json;

?>