<?php

require_once('./../controller/controller.php');

$filecontroller = new Filecontroller();
$fileresult = $filecontroller->filedelete();

$fileresponse = '非同期通信 & file削除 成功';
echo json_encode($fileresponse);
echo $json;